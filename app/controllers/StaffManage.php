<?php

namespace App\controllers;

use App\core\Controller;

class StaffManage
{
    use Controller;
    public function index()
    {

        $this->view('Admin/User/StaffManage');
    }
}