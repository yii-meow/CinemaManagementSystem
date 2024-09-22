<?php
/**
 * Author: Chong Kah Yan
 */
namespace App\controllers;

use App\core\Controller;

class verifyOTP
{
    use Controller;

    public function index()
    {
        $errorMessage = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $otpCode = $_POST['otpCode'];

            // Check if OTP is set in the session and validate it
            if (isset($_SESSION['otp_code']) && isset($_SESSION['otp_expiry']) && isset($_SESSION['phoneNo'])) {
                if ($_SESSION['otp_code'] == $otpCode) {
                    // Check if OTP has expired
                    if (time() <= $_SESSION['otp_expiry']) {
                        // Success: Store a success message in the session
                        $_SESSION['success_message'] = 'OTP verified successfully. You can now reset your password.';

                        // Unset OTP session data (but keep phoneNo for ResetPass)
                        unset($_SESSION['otp_code']);
                        unset($_SESSION['otp_expiry']);

                        // Redirect to the Reset Password page, passing phoneNo in session
                        $this->view('Customer/User/ResetPass', ['phoneNo' => $_SESSION['phoneNo'], 'success_message' => $_SESSION['success_message']]);
                        exit;
                    } else {
                        // OTP has expired
                        $errorMessage = 'OTP has expired. Please request a new one.';

                        // Clear OTP session data
                        unset($_SESSION['otp_code']);
                        unset($_SESSION['otp_expiry']);
                    }
                } else {
                    $errorMessage = 'Invalid OTP code.';
                }
            } else {
                $errorMessage = 'OTP is not set or has expired.';
            }

            // Render the view with the error message
            $this->view('Customer/User/verifyOTP', ['error' => $errorMessage]);
        }
    }
}