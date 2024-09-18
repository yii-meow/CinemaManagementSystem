<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;

class SessionManagement
{
    private $timeoutDuration = 600; // 10 minutes

    public function __construct()
    {
        $this->sessionTimeout();
    }

    public function sessionTimeout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $this->timeoutDuration) {
            // Last request was more than 10 minutes ago
            session_unset(); // Clear session data
            session_destroy(); // Destroy session
            header('Location: /login'); // Redirect to login page
            exit();
        }

        // Update last activity time
        $_SESSION['last_activity'] = time();
    }

    protected function view($view, $data = [])
    {
        $this->view($view, $data);
    }
}
?>
