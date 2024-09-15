<?php

namespace App\controllers;

use App\core\Controller;

class RewardManage
{
    use Controller;
    public function index()
    {

        $this->view('Admin/User/RewardManage');
    }
}