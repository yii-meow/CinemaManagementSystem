<?php
/**
 * Author: Chong Kah Yan
 */

use App\core\Controller;

class RequestOTP
{
    use Controller;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = '+60' . $_POST['phoneNo'];
            $otpCode = rand(100000, 999999); // Generate OTP code

            // Store OTP and expiry time in session
            $_SESSION['phoneNo'] = $_POST['phoneNo'];
            $_SESSION['otp_code'] = $otpCode;
            $_SESSION['otp_expiry'] = time() + 60; // OTP valid for 5 minutes

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

            // Handle HTTP request errors
            $response = @file_get_contents($url, false, $context); // Suppress errors with @

            if ($response === FALSE) {
                // Network error or server is down
                $error = 'Failed to request OTP. Please check your Phone Number is correct.';
                $this->view('Customer/User/ForgetPassVerify', ['error' => $error]);
                return;
            }

            $responseData = json_decode($response, true);

            // Handle JSON response errors
            if ($responseData && !$responseData['success']) {
                $error = 'Error: ' . $responseData['message'];
                $this->view('Customer/User/ForgetPassVerify', ['error' => $error]);
            } else {
                // Success: Store a success message in the session
                $_SESSION['success_message'] = 'OTP sent successfully. Please verify your OTP.';

                // Redirect to the verify OTP page
                $this->view('Customer/User/verifyOTP');
                exit;
            }
        }
    }
}