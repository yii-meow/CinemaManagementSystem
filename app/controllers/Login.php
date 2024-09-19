<?php

namespace App\controllers;

use App\Factory\UserFactory;
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

    private $userFactory;



    public function __construct()
    {
        parent::__construct(); // apply session timeout check
//        // Initialize EntityManager and User repository
//        $this->entityManager = Database::getEntityManager();
//        $this->userRepository = $this->entityManager->getRepository(User::class);
//        $this->adminRepository = $this->entityManager->getRepository(Admin::class);
        //For Session Management
        $this->sessionManager = new SessionManagement();

        $this->userFactory = new UserFactory();

    }

    public function index()
    {

        $data = ['error' => null];
        $userType = $_POST['userType'] ?? 'user';  // Default to 'user' if not provided

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = $_POST['phoneNo'] ?? null;
            $password = $_POST['password'] ?? null;

            // Validate input
            if (empty($phoneNo) || empty($password)) {
                $data['error'] = "Please provide both phone number and password.";
            } else {
                $result = $this->userFactory->login($userType, $phoneNo, $password);


                if (isset($result['error'])) {
                    $data['error'] = $result['error'];

                    if($userType === 'admin'){
                        $this->view('Customer/User/LoginStaff', $data);
                        exit();
                    }
                    $this->view('Customer/User/Login', $data);
                    exit();
                } else if (isset($result['success_message'])) {
                    $data['success_message'] = $result['success_message'];
                    if($userType === 'admin'){
                        $data['admin'] = $result['user'];
                        $this->view('Admin/User/AdminProfile', $data);
                        exit();
                    }else{
                        $data['user'] = $result['user'];
                        $this->view('Customer/User/Profile', $data);
                        exit();
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