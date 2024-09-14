<?php
namespace App\controllers;
use App\core\Controller;
class ResetPass
{
    use Controller;

    public function index()
    {

        //Please do use this only at the end of the operations
        $this->view('Customer/User/ResetPass');
    }
}