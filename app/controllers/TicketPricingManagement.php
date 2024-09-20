<?php

namespace App\controllers;

use App\core\Controller;

class TicketPricingManagement
{
    use Controller;

    public function index()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'SuperAdmin') {
            $this->view('Admin/Ticket/TicketPricingManagement');
        } else {
            $this->view("Admin/403PermissionDenied");
        }
    }
}