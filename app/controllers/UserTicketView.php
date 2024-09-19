<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\core\Encryption;
use App\models\Ticket;
use App\models\Payment;
use App\repositories\TicketRepository;
use Doctrine\ORM\EntityRepository;

class UserTicketView
{
    use Controller;

    private $entityManager;
    private ticketRepository $ticketRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->ticketRepository = $this->entityManager->getRepository(Ticket::class);
    }

    public function index()
    {

        //Decryption Process
        $decryption = new Encryption();
        $ticketId = (int)$decryption->decrypt($_GET['ticketId'], $decryption->getKey());

        //Find ticket info
        $ticket = $this->ticketRepository->findTicketById($ticketId);
        if ($ticket) {
            $data = [
                "ticket" => $ticket,
            ];
        } else {
            $data = [
                "error" => "ERROR",
            ];
        }

        // show($data);

        $this->view("Admin/Ticket/UserTicketView", $data);
    }


    public function UpdateRecord()
    {
        $ticketId = (int)$_POST['ticketId'];
        $paymentStatus = (string)$_POST['paymentStatus'];
        $ticketStatus = (string)$_POST['ticketStatus'];
        $direction = (string)$_POST['direction'];

        // Initialize response
        $response = ["success" => false, "message" => "Unknown error occurred."];

        // Ticket Object
        $ticket = $this->ticketRepository->find($ticketId);

        if ($ticket) {
            // Update Ticket
            $ticket->setTicketStatus($ticketStatus);
            $this->entityManager->persist($ticket);

            // Payment Object
            $payment = $this->entityManager->getRepository(Payment::class)->find($ticket);

            if ($payment) {
                // Update Payment
                $payment->setPaymentStatus($paymentStatus);
                $this->entityManager->persist($payment);

                // Synchronize records
                $this->entityManager->flush();

                // Return success response
                $response = ["success" => true, "message" => "Record updated successfully."];
            } else {
                // Payment not found
                $response['message'] = "Payment record not found.";
            }
        } else {
            // Ticket not found
            $response['message'] = "Ticket record not found.";
        }

        // Send response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

}