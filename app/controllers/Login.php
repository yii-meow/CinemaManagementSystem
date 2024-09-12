<?php

class Login
{
    use Controller;

    public function index()
    {
        $data = ['error' => null];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if phone number and password are provided
            if (empty($_POST['phoneNo']) || empty($_POST['password'])) {
                $data['error'] = "Please provide both phone number and password.";
            } else {
                $phoneNo = $_POST['phoneNo'];
                $password = $_POST['password'];

                $userModel = new User();
                $user = $userModel->getUserByPhoneNo($phoneNo);

                // Check if user exists and passwords match (plaintext comparison)
                if ($user && $user->password === $password) {
                    session_start();
                    $_SESSION['userId'] = $user->userId;

                    // Redirect to the profile page
                    $this->view('Customer/User/Profile', $data);
                    exit();
                } else {
                    $data['error'] = "Invalid phone number or password.";
                }
            }
        }

        $this->view('Customer/User/Login', $data);
    }
}