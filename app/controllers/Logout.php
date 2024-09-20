<?php

namespace App\controllers;

use App\core\Controller;
use App\controllers\SessionManagement;

class Logout extends SessionManagement
{
    use Controller;

    public function index()
    {
        // Start session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //[logout functionality - fully terminate session]
        // Clear the session array
        $_SESSION = [];

        // Destroy session cookies if set
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session itself
        session_destroy();

        // Redirect to the login page [Once logout cannot access again, must login first]
        $this->view('Customer/User/Login');
        exit();
    }
}