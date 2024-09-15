<?php

namespace App\controllers;

use App\core\Controller;

class AdminProfile
{
    use Controller;
    public function index()
    {

        $this->view('Admin/User/AdminProfile');
    }
}