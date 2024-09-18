<?php

namespace App\controllers;

use App\models\Admin; // Adjust if the model class name is different
use App\core\Controller;
use App\core\Database;

class StaffView
{
    use Controller;

    private $entityManager;
    private $adminRepository; // Assuming the model for staff is Admin

    public function __construct()
    {
        // Initialize EntityManager and Admin repository
        $this->entityManager = Database::getEntityManager();
        $this->adminRepository = $this->entityManager->getRepository(Admin::class);
    }

    public function index()
    {
        $staffId = $_GET['staffId'] ?? null;

        if ($staffId) {
            // Fetch the specific staff from the database
            $staff = $this->adminRepository->find($staffId);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $response = [];

                // Handle updating staff details
                if (isset($_POST['staffName']) && isset($_POST['phoneNo'])) {
                    $staffName = $_POST['staffName'];
                    $phoneNo = $_POST['phoneNo'];

                    // Check if the phone number is unique
                    $existingStaff = $this->adminRepository->findOneBy(['phoneNo' => $phoneNo]);

                    if ($existingStaff && $existingStaff->getUserId() != $staffId) {
                        // Phone number is already in use
                        $response['error'] = 'Phone number already exists.';
                    } else {
                        // Update staff details
                        $staff->setUserName($staffName);
                        $staff->setPhoneNo($phoneNo);

                        $this->entityManager->persist($staff);
                        $this->entityManager->flush();

                        $response['success'] = 'Staff details updated successfully.';
                    }
                } elseif (isset($_POST['delete'])) {
                    // Check if the user has a "SuperAdmin" role
                    if ($staff->getRole() === 'SuperAdmin') {
                        $response['error'] = 'You cannot delete a SuperAdmin.';
                    } else {
                        // Handle deletion for non-SuperAdmin
                        $this->entityManager->remove($staff);
                        $this->entityManager->flush();

                        $response['success'] = 'Staff deleted successfully.';
                    }
                } else {
                    $response['error'] = 'Invalid form submission.';
                }

                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }

            if ($staff) {
                $data = [
                    'staff' => $staff
                ];

                // Render the StaffView with the staff data
                $this->view('Admin/User/StaffView', $data);
            } else {
                echo "Staff not found.";
            }
        } else {
            echo "No staff ID provided.";
        }
    }
}