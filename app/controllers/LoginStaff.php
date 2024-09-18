<?php

namespace App\controllers;

use App\core\Controller;

class LoginStaff
{
    use Controller;

    public function index()
    {

        // Render the login view
        $this->view('Customer/User/LoginStaff');
    }

}