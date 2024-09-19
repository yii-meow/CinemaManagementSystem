<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Admin;

class StaffManage
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
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'SuperAdmin') {

            $error = null; // Initialize an error message variable
            $searchQuery = $_GET['search'] ?? null; // Get the search query from the URL


            // Check if form is submitted via POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get data from the form submission
                $staffName = $_POST['staffName'] ?? null;
                $phoneNo = $_POST['phoneNo'] ?? null;
                $defaultPassword = 'staffpass';  // Default password
                $role = 'Staff';  // Default role

                // Validate the form data (basic validation)
                if ($staffName && $phoneNo) {
                    // Check if a staff member with the same phoneNo already exists
                    $existingStaff = $this->adminRepository->findOneBy(['phoneNo' => $phoneNo]);

                    if ($existingStaff) {
                        // If a staff member with the same phoneNo exists, set an error message
                        $error = 'A staff member with this phone number already exists!';
                    } else {
                        // Hash the default password
                        $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

                        // Create a new Admin (staff) entity
                        $staff = new Admin();
                        $staff->setUserName($staffName);
                        $staff->setPhoneNo($phoneNo);
                        $staff->setPassword($hashedPassword);
                        $staff->setRole($role);

                        // Persist the new staff member to the database
                        $this->entityManager->persist($staff);
                        $this->entityManager->flush();

                        // Redirect to prevent form resubmission and show the updated list
                        header('Location: ' . ROOT . '/StaffManage');
                        exit();
                    }
                }
            }

            // Fetch staff members based on the search query
            if ($searchQuery) {
                // Search staff by name or phone number
                $staff = $this->adminRepository->createQueryBuilder('a')
                    ->where('a.userName LIKE :searchQuery OR a.phoneNo LIKE :searchQuery')
                    ->setParameter('searchQuery', '%' . $searchQuery . '%')
                    ->getQuery()
                    ->getResult();
            } else {
                // Fetch all staff members (Admin users) from the database if no search query
                $staff = $this->adminRepository->findAll();
            }

            // Pass the list of staff and the error message (if any) to the view
            $data = [
                'staff' => $staff,
                'error' => $error,
                'searchQuery' => $searchQuery
            ];

            // Render the StaffManage view with the staff data and potential error message
            $this->view('Admin/User/StaffManage', $data);
        }else {
            // Redirect to permission denied page if user is not a SuperAdmin
            $this->view("Admin/403PermissionDenied");
        }
    }
}