<?php

namespace App\controllers;

use App\core\Controller;

class TicketPricingManagement
{
    use Controller;

    public function index()
    {
        $this->view('Admin/Ticket/TicketPricingManagement');
    }
}