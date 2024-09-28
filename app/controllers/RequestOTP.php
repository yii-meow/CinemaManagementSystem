<?php
/**
 * Author: Chong Kah Yan
 */
namespace App\controllers;

use App\core\Controller;

class RequestOTP
{
    use Controller;

    public function index()
    {
        session_start(); // Ensure the session is started

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = '+60' . $_POST['phoneNo'];
            $otpCode = rand(100000, 999999); // Generate OTP code

            // Store OTP and expiry time in session
            $_SESSION['phoneNo'] = $_POST['phoneNo'];
            $_SESSION['otp_code'] = $otpCode;
            $_SESSION['otp_expiry'] = time() + 60; // OTP valid for 5 minutes

            // Send OTP request to Node.js server using cURL
            $url = 'http://localhost:3000/send-otp';
            $data = json_encode(['phoneNo' => $phoneNo, 'otpCode' => $otpCode]);

            // Initialize cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($ch);

            // Handle cURL errors
            if ($response === false) {
                $error = curl_error($ch);
                curl_close($ch);
                $this->view('Customer/User/ForgetPassVerify', ['error' => 'Failed to request OTP. Please try again later. ' . $error]);
                return;
            }

            curl_close($ch);

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