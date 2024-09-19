<?php

namespace App\controllers;

use App\core\Controller;

class ReportManage
{
    use Controller;
    public function index(){

        $this->view("Admin/Report/ReportManage");
    }
}