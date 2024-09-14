<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\User;

class Register
{
    use Controller;

    private $entityManager;
    private $userRepository;

    public function __construct()
    {
        // Initialize entityManager and repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function index()
    {
        $data = ['error' => null];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect and sanitize input
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phoneNo = $_POST['phoneNo'] ?? '';
            $password = $_POST['password'] ?? '';
            $cpassword = $_POST['cpassword'] ?? '';
            $birthday = $_POST['birthday'] ?? '';
            $gender = $_POST['gender'] ?? '';

            // Validate input
            if (empty($name) || empty($email) || empty($phoneNo) || empty($password) || empty($cpassword)) {
                $data['error'] = 'Please fill in all required fields.';
            } elseif ($password !== $cpassword) {
                $data['error'] = 'Passwords do not match.';
            } else {
                // Check if user already exists
                $existingUser = $this->userRepository->findOneBy(['phoneNo' => $phoneNo]);

                if ($existingUser) {
                    $data['error'] = 'User with this phone number already exists.';
                } else {
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    // Create new user
                    $user = new User();
                    $user->setUserName($name)
                        ->setEmail($email)
                        ->setBirthDate($birthday)
                        ->setGender($gender)
                        ->setPhoneNo($phoneNo)
                        ->setPassword($hashedPassword) // Store hashed password
                        ->setCoins(0);

                    // Persist user data
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();

                    // Redirect to success page or login
                    $this->view('Customer/User/Login', $data);
                    exit();
                }
            }
        }

        // Render the registration form view
        $this->view('Customer/User/Register', $data);
    }
}