<?php

namespace App\controllers;

use App\models\Admin;
use App\core\Controller;
use App\core\Database;

class AdminProfile
{
    use Controller;

    private $entityManager;
    private $adminRepository;

    public function __construct()
    {
        // Initialize EntityManager and Admin repository
        $this->entityManager = Database::getEntityManager();
        $this->adminRepository = $this->entityManager->getRepository(Admin::class);
    }

    public function index()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Initialize an array to hold messages
        $messages = [];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminId = $_SESSION['admin']['userId'] ?? null;
            $currentPassword = $_POST['currentPassword'] ?? '';
            $newPassword = $_POST['adminPassword'] ?? '';
            $username = $_POST['adminUsername'] ?? '';
            $phoneNo = $_POST['adminPhoneNo'] ?? '';

            if ($adminId) {
                $admin = $this->adminRepository->find($adminId);

                if ($admin) {
                    // Check for duplicate phone number
                    $existingAdmin = $this->adminRepository->findOneBy(['phoneNo' => $phoneNo]);
                    if ($existingAdmin && $existingAdmin->getUserId() !== $adminId) {
                        $messages[] = 'Phone number is already in use.';
                    } else {
                        // Update admin details
                        $admin->setUserName($username);
                        $admin->setPhoneNo($phoneNo);

                        if (!empty($newPassword)) {
                            // Validate the current password if new password is provided
                            if (password_verify($currentPassword, $admin->getPassword())) {
                                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                                $admin->setPassword($hashedPassword);
                                $messages[] = 'Profile updated successfully.';
                            } else {
                                $messages[] = 'Current password is incorrect.';
                            }
                        } else {
                            $messages[] = 'Profile updated successfully.';
                        }

                        $this->entityManager->persist($admin);
                        $this->entityManager->flush();
                    }
                } else {
                    $messages[] = 'Admin not found.';
                }
            } else {
                $messages[] = 'No admin logged in.';
            }
        }

        // Fetch admin details
        $adminId = $_SESSION['admin']['userId'] ?? null;
        if ($adminId) {
            $admin = $this->adminRepository->find($adminId);
            $data = ['admin' => $admin, 'messages' => $messages];
            $this->view('Admin/User/AdminProfile', $data);
        } else {
            $data = ['messages' => ['No admin logged in.']];
            $this->view('Admin/User/AdminProfile', $data);
        }
    }
}