<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;

class SessionManagement
{
    use Controller;
    private $timeoutDuration = 1200; // 20 minutes

    public function __construct()
    {
        // Ensure the session is started and call session timeout check
        $this->sessionTimeout();
    }

    public function sessionTimeout()
    {
        // Start session if it hasn't already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the session has timed out
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $this->timeoutDuration) {
            session_unset(); // Clear session data
            session_destroy(); // Destroy session

            // Redirect to the login page
            header('Location:' . ROOT . '/Login/index?timeout=true');
            exit(); // Stop further script execution
        }

        // Update last activity time
        $_SESSION['last_activity'] = time();
    }
}
?>
