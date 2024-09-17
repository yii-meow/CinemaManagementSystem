<?php
namespace App\controllers;

use App\core\Controller;

class MovieManagement
{
    use Controller;

    public function index()
    {
        return $this->view("Admin/Movie/MovieManagement");
    }
}