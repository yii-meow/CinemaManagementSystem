<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\core\Encryption;
use App\models\Movie;

class UserPurchasedTicket
{
    use Controller;
    public function index(){

        $this->view("Admin/Ticket/UserPurchasedTicket");
    }
}