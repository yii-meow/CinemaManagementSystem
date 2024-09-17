<?php
namespace App\controllers;

use App\core\Controller;

class verifyOTP
{
    use Controller;

    public function index()
    {
        $response = [
            'success' => false,
            'message' => 'Invalid OTP code.'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $otpCode = $_POST['otpCode'];

            // Check if OTP is set in the session and validate it
            if (isset($_SESSION['otp_code']) && isset($_SESSION['otp_expiry'])) {
                if ($_SESSION['otp_code'] == $otpCode) {
                    // Check if OTP has expired
                    if (time() <= $_SESSION['otp_expiry']) {
                        $response['success'] = true;
                        $response['message'] = 'OTP verified successfully.';
                        // Optionally, you might want to unset OTP values from the session here
                        unset($_SESSION['otp_code']);
                        unset($_SESSION['otp_expiry']);

                        // Redirect to the Reset Password page
                        $this->view('Customer/User/ResetPass');
                        exit;
                    } else {
                        $response['message'] = 'OTP has expired. Please request a new one.';
                    }
                } else {
                    $response['message'] = 'Invalid OTP code.';
                }
            } else {
                $response['message'] = 'OTP is not set or has expired.';
            }

            // Render verifyOTP view with error message
            $this->view('Customer/User/verifyOTP');
            echo json_encode($response);
        }
    }
}