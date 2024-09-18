<?php

namespace App\controllers;

use App\models\Admin;
use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\controllers\SessionManagement;

class Login extends SessionManagement
{
    use Controller;

    private $entityManager;
    private $userRepository;
    private $adminRepository;
    private $sessionManager;



    public function __construct()
    {
        parent::__construct(); // apply session timeout check
        // Initialize EntityManager and User repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->adminRepository = $this->entityManager->getRepository(Admin::class);


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
        $userType = $_POST['userType'] ?? 'user';  // Default to 'user' if not provided

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = $_POST['phoneNo'] ?? null;
            $password = $_POST['password'] ?? null;

            // Validate input
            if (empty($phoneNo) || empty($password)) {
                $data['error'] = "Please provide both phone number and password.";
            } else {
                // Handle user or admin login based on userType
                if ($userType === 'admin') {
                    // Admin login logic
                    $admin = $this->adminRepository->findOneBy(['phoneNo' => $phoneNo]);

                    if ($admin && password_verify($password, $admin->getPassword())) {
                        $_SESSION['admin'] = [
                            'userId' => $admin->getUserId(),
                            'userName' => $admin->getUserName(),
                            'role' => $admin->getRole(),
                        ];
                        // Redirect to AdminProfile
                        $admin = $this->adminRepository->find($admin->getUserId());
                        $data = ['admin' => $admin];
                        $this->view('Admin/User/AdminProfile', $data);
                        exit();
                    } else {
                        $data['error'] = "Invalid phone number or password for admin.";
                    }
                } else {
                    // User login logic
                    $user = $this->userRepository->findOneBy(['phoneNo' => $phoneNo]);

                    if ($user) {
                        // Check if user is active
                        if ($user->getStatus() === 'deactive') {
                            $data['error'] = "Your account is deactivated. Please contact support.";
                        } else if (password_verify($password, $user->getPassword())) {
                            $_SESSION['userId'] = $user->getUserId();
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
                            // Redirect to the user profile page
                            $this->view('Customer/User/Profile', $data);
                            exit();
                        } else {
                            $data['error'] = "Invalid phone number or password for user.";
                        }
                    } else {
                        $data['error'] = "User not found.";
                    }
                }
            }
        }

        // Render the appropriate login view based on userType
        if ($userType === 'admin') {
            $this->view('Customer/User/LoginStaff', $data);
        } else {
            $this->view('Customer/User/Login', $data);
        }
    }
}