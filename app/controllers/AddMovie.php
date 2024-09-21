<?php

namespace App\controllers;

use App\core\Controller;

class AddMovie
{
    use Controller;

    public function index()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'SuperAdmin') {
            return $this->view("Admin/Movie/AddMovie");
        } else {
            $this->view("Admin/403PermissionDenied");
        }
    }
}