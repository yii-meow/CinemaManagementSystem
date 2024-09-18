<?php
namespace App\controllers;

use App\core\Controller;

class AddMovie
{
    use Controller;

    public function index()
    {
        return $this->view("Admin/Movie/AddMovie");
    }
}