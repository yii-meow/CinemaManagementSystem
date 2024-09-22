<?php
/**
 * Author: Chong Kah Yan
 */
namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;

class ResetPass
{
    use Controller;

    private $entityManager;
    private $userRepository;

    public function __construct()
    {
        // Initialize EntityManager and User repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function index()
    {
        $data = ['error' => null, 'success_message' => null];

        // Ensure phoneNo exists in session from the OTP verification step
        if (!isset($_SESSION['phoneNo'])) {
            $data['error'] = "Session expired. Please verify OTP again.";
            $this->view('Customer/User/Login', $data); // Redirect back to login
            exit();
        }

        // Handle POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = $_SESSION['phoneNo'];
            $newPassword = $_POST['password'] ?? null;
            $confirmPassword = $_POST['cpassword'] ?? null;

            // Validate input
            if (empty($newPassword) || empty($confirmPassword)) {
                $data['error'] = "Please fill in both password fields.";
            } elseif ($newPassword !== $confirmPassword) {
                $data['error'] = "Passwords do not match.";
            } elseif (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}/', $newPassword)) {
                $data['error'] = "Password must be at least 6 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.";
            } else {
                // Fetch the user by phoneNo
                $user = $this->userRepository->findOneBy(['phoneNo' => $phoneNo]);

                if ($user) {
                    // Hash the new password
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $user->setPassword($hashedPassword);

                    // Persist changes to the database
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();

                    // Success: Set a success message and redirect to login
                    $_SESSION['success_message'] = "Password reset successfully. Please log in.";
                    unset($_SESSION['phoneNo']); // Clear the session phone number after resetting

                    $this->view('Customer/User/Login', ['success_message' => $_SESSION['success_message']]);
                    exit();
                } else {
                    $data['error'] = "User not found.";
                }
            }
        }

        // Render the Reset Password view
        $this->view('Customer/User/ResetPass', $data);
    }
}