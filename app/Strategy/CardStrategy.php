<?php
/**
 * @Chew Zi An
 */

namespace App\Strategy;


//Concrete Strategy
use App\core\Database;
use App\core\Encryption;
use App\models\Cinema;
use App\models\CinemaHall;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\Payment;
use App\models\Seat;
use App\models\Ticket;
use App\models\TicketPricing;
use App\models\User;
use App\models\UserReward;
use App\services\QRCodeGenerator;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\ORMException;

class CardStrategy implements PaymentStrategy
{

    private $entityManager;
    private $movieScheduleRepository;
    private $cinemaHallRepository;
    private $userRepository;
    private $ticketRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->ticketRepository = $this->entityManager->getRepository(Ticket::class);
    }

    //Processing
    public function pay(array $paymentData)
    {
        //Gather all info needed
        //Basic
        $amount = $paymentData['amount'];
        $custInfo = $paymentData['custInfo'];
        $hallId = $paymentData['hallId'];
        $scheduleId = $paymentData['scheduleId'];
        $seats = $paymentData['seats'];
        $userId = $paymentData['userId'];
        $date = $paymentData['date'];
        $paymentMethod = (string)$paymentData['paymentMethod'];

        //Card
        $cardType = $paymentData['cardType'];
        $cardNumber = $paymentData['cardNumber'];
        $expiryDate = $paymentData['expiryDate'];
        $cvv = $paymentData['cvv'];

        //DATABASE PROCESSING
        try {
            //Store into Ticket
            $ticket = new Ticket();
            $ticket->setMovieSchedule($this->movieScheduleRepository->find($scheduleId));
            $ticket->setTicketStatus('Upcoming'); // Set the ticket status
            $ticket->setUser($this->userRepository->find($userId));  //Store as Foreign Key, only takes ID of the Entity even pass in obj
            $this->entityManager->persist($ticket);

            //After inserted Ticket, the ID is returned after flush
            $this->entityManager->flush();
            $ticketId = $ticket->getTicketId();

            //API
            $qrCodeGenerator = new QRCodeGenerator();
            $qrCodeUrl = $qrCodeGenerator->generateQRCode($ticketId);
            $ticket->setQrCodeURL($qrCodeUrl);
            $this->entityManager->persist($ticket);
            //END OF API

            $insertedTicket = $this->ticketRepository->find($ticketId);

            //Store into Seat = Seat may have multiple for one purchase
            $seatArr = explode('|', $seats);
            foreach ($seatArr as $seatNo) {
                $seat = new Seat();
                $seat->setSeatNo($seatNo);   //Normal Column
                $seat->setCinemaHall($this->cinemaHallRepository->find($hallId));
                $seat->setTicket($insertedTicket);
                $this->entityManager->persist($seat);
            }

            //Store into Payment
            $encryption = new Encryption();
            //Prepare Card Details
            $info = $cardType . '|' . $cardNumber . '|' . $expiryDate . '|' . $cvv;
            $payment = new Payment();
            $payment->setTotalPrice($amount);
            $payment->setPaymentMethod($paymentMethod);
            $payment->setCustInfo($custInfo);
            $payment->setPaymentStatus("Paid");
            $payment->setPaymentInfo($encryption->encrypt($info, $encryption->getKey()));
            $payment->setTicket($insertedTicket);
            $this->entityManager->persist($payment);


            //Synchronize the state of your objects with the database
            $this->entityManager->flush();

            //Redirection to Payment Confirmation Page
            return $ticketId;

        } catch (Exception $e) {
            error_log('Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            throw new \RuntimeException($e);
        } catch (ORMException $e) {
            error_log('ORM error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            throw new \RuntimeException($e);
        }


    }

}