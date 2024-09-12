<?php

class Register
{
    use Controller;

    public function index()
    {
        $data = ['error' => null];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                $userModel = new User();
                $existingUser = $userModel->getUserByPhoneNo($phoneNo);

                if ($existingUser) {
                    $data['error'] = 'User with this phone number already exists.';
                } else {
                    // Insert new user
                    $userData = [
                        'userName' => $name,
                        'email' => $email,
                        'birthDate' => $birthday,
                        'gender' => $gender,
                        'phoneNo' => $phoneNo,
                        'password' => $password, // No hashing yet
                        'coins' => 0
                    ];

                    $userModel->createUser($userData);

                    // Redirect to success page or login
                    $this->view('Customer/User/Login', $data);
                    exit();
                }
            }
        }

        $this->view('Customer/User/Register', $data);
    }
}