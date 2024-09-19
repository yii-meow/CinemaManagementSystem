<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\core\Encryption;
use App\models\Movie;
use App\models\Ticket;

class PurchaseHistory
{
    use Controller;


    private $entityManager;
    private $ticketRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->ticketRepository = $this->entityManager->getRepository(Ticket::class);
    }

    public function index() {

        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            $this->view('Customer/User/Login');
            exit();
        }

        $userId = (int)$_SESSION['userId'];
        //$userId = 6; //TestUID

        //Find all movie
        $result = $this->ticketRepository->findUserTickets($userId);
        $ticketData = [];
        if($result){
            foreach ($result as $ticket) {
                $ticketData[] = $ticket;
            }
        }

        // Count no of tickets
        $noOfTicket = count($ticketData);

        // Combines multiple $data from different queries
        $data = [
            'records' => $ticketData,
            'ticketCount' => $noOfTicket,
        ];


        //show($data);


        $this->view("Customer/Payment/PurchaseHistory",$data);
    }


}