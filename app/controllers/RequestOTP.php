<?php
namespace App\controllers;
use App\core\Controller;

class RequestOTP
{
    use Controller;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = $_POST['phoneNo'];
            $otpCode = rand(100000, 999999); // Generate OTP code

            // Store OTP and expiry time in session
            $_SESSION['otp_code'] = $otpCode;
            $_SESSION['otp_expiry'] = time() + 300; // OTP valid for 5 minutes

            // Send OTP request to Node.js server
            $url = 'http://localhost:3000/send-otp';
            $data = json_encode(['phoneNo' => $phoneNo, 'otpCode' => $otpCode]);

            $options = [
                'http' => [
                    'header' => "Content-Type: application/json\r\n",
                    'method' => 'POST',
                    'content' => $data,
                ],
            ];
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);

            // Handle response
            if ($response === FALSE) {
                // Error handling
                echo 'Failed to connect to OTP server.';
                return;
            }

            $responseData = json_decode($response, true);

            if ($responseData['success']) {
                // Redirect to verify OTP page
                $this->view('Customer/User/verifyOTP');
                exit;
            } else {
                // Handle failure
                echo 'Failed to send OTP: ' . $responseData['message'];
            }
        }
    }
}