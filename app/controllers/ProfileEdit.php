<?php
namespace App\controllers;
use App\core\Controller;
class ProfileEdit
{
    use Controller;

    public function index()
    {

        //Please do use this only at the end of the operations
        $this->view('Customer/User/ProfileEdit');
    }
}