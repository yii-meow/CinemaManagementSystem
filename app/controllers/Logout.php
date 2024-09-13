<?php

class Logout
{
    public function index()
    {

        // Destroy all session data
        $_SESSION = array(); // Clear the session array
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy(); // Destroy the session itself

        // Redirect to the login page
        header('Location: ' . ROOT . '/Login');
        exit();
    }
}