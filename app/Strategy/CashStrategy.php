<?php

namespace App\Strategy;
/**
 * @Chew Zi An
 */


//Concrete Strategy
use App\core\Database;
use App\core\Encryption;
use App\models\Cinema;
use App\models\CinemaHall;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\Seat;
use App\models\Ticket;
use App\models\TicketPricing;
use App\models\User;
use App\models\Payment;
use App\models\UserReward;
use App\services\QRCodeGenerator;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\ORMException;

class CashStrategy implements PaymentStrategy
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
        //Basic - Cash only has basic
        $amount = (float)$paymentData['amount'];
        $custInfo = (string)$paymentData['custInfo'];
        $hallId = (int)$paymentData['hallId'];
        $scheduleId = (int)$paymentData['scheduleId'];
        $seats = (string)$paymentData['seats'];
        $userId = (int)$paymentData['userId'];
        $date = (string)$paymentData['date'];
        $paymentMethod = (string)$paymentData['paymentMethod'];


        try {

            //DATABASE PROCESSING
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
            $payment = new Payment();
            $payment->setTotalPrice($amount);
            $payment->setPaymentMethod($paymentMethod);
            $payment->setCustInfo($custInfo);
            $payment->setPaymentStatus("Unpaid");
            $payment->setPaymentInfo($encryption->encrypt("Cash Payment", $encryption->getKey()));
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
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

}