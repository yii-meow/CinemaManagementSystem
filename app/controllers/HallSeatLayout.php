<?php

namespace App\controllers;

use App\core\Controller;

class HallSeatLayout
{
    use Controller;

    public function index()
    {
        return $this->view("Admin/Hall/HallSeatLayout");
    }
}
