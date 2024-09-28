<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\controllers;

use App\core\Controller;
use App\core\Database;

class SessionManagement
{
    private $timeoutDuration = 900; //demo  //900; // 15 minutes

    public function __construct()
    {
        $this->sessionTimeout();
    }

    public function sessionTimeout()
    {
        // check no session started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();// initialize the session
        }

        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $this->timeoutDuration) {
            // Last request was more than 15 minutes
            session_unset(); // Clear session data
            session_destroy(); // Destroy session
            header('Location: '.ROOT.'/Login?timeout=true'); // Redirect to login page
            exit();
        }

        // Update last activity time
        $_SESSION['last_activity'] = time();
    }
}
?>
