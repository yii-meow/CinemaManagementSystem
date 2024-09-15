<?php

namespace App\controllers;

use App\core\Controller;

class StaffView
{
    use Controller;
    public function index()
    {

        $this->view('Admin/User/StaffView');
    }
}