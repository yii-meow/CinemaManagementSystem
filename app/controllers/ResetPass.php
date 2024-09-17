<?php

namespace App\controllers;

use App\core\Controller;

class ResetPass
{
    use Controller;
    public function index()
    {

        // Render the UserManage view with the user data
        $this->view('Admin/User/ResetPass');
    }
}