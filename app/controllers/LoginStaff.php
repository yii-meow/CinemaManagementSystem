<?php
namespace App\controllers;
use App\core\Controller;
class LoginStaff
{
    use Controller;

    public function index()
    {

        //Please do use this only at the end of the operations
        $this->view('Customer/User/LoginStaff');
    }
}