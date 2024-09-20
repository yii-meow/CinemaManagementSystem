<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\controllers\SessionManagement;

class Login extends SessionManagement
{
    use Controller;

    private $entityManager;
    private $userRepository;
    private $sessionManager;


    public function __construct()
    {
        parent::__construct(); // apply session timeout check
        // Initialize EntityManager and User repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);

        //For Session Management
        $this->sessionManager = new SessionManagement();

    }

    public function index()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data = ['error' => null];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = $_POST['phoneNo'] ?? null;
            $password = $_POST['password'] ?? null;

            // Validate input
            if (empty($phoneNo) || empty($password)) {
                $data['error'] = "Please provide both phone number and password.";
            } else {
                // Fetch the user from the repository by phone number
                $user = $this->userRepository->findOneBy(['phoneNo' => $phoneNo]);

                // Check if user exists and password matches
                if ($user && password_verify($password, $user->getPassword())) {
                    // Destroy any previous session (S.C [Establish a new session after successful login])
                    session_destroy();
                    // Start a new session
                    session_start();
                    session_regenerate_id(true); // Generate a new session ID


                    $_SESSION['userId'] = $user->getUserId();

                    // Set last activity time for session management (S.C)
                    $_SESSION['last_activity'] = time();

                    // Pass the user data to the profile view
                    $data['user'] = [
                        'userId' => $user->getUserId(),
                        'profileImg' => $user->getProfileImg(),
                        'userName' => $user->getUserName(),
                        'phoneNo' => $user->getPhoneNo(),
                        'email' => $user->getEmail(),
                        'gender' => $user->getGender(),
                        'birthDate' => $user->getBirthDate(),
                        'coins' => $user->getCoins()
                    ];
                    // Redirect to the profile page
                    $this->view('Customer/User/Profile', $data);
                    exit();
                } else {
                    $data['error'] = "Invalid phone number or password.";
                }
            }
        }

        // Render the login view
        $this->view('Customer/User/Login', $data);
    }
}