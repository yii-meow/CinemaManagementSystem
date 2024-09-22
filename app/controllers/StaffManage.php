<?php
/**
 * Author: Chong Kah Yan
 */
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
            $success = null; // Initialize a success message variable
            $searchQuery = $_GET['search'] ?? null; // Get the search query from the URL

            // Check if form is submitted via POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get data from the form submission
                $staffName = $_POST['staffName'] ?? null;
                $phoneNo = $_POST['phoneNo'] ?? null;
                $defaultPassword = '@Bc123';  // Default password
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

                        // Redirect to prevent form resubmission and show the updated list with success message
                        header('Location: ' . ROOT . '/StaffManage?success=Staff%20member%20added%20successfully');
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

            // Get the success message from the URL
            $success = $_GET['success'] ?? null;

            // Pass the list of staff, error message, and success message (if any) to the view
            $data = [
                'staff' => $staff,
                'error' => $error,
                'success' => $success,
                'searchQuery' => $searchQuery
            ];

            // Render the StaffManage view with the staff data, potential error message, and success message
            $this->view('Admin/User/StaffManage', $data);
        } else {
            // Redirect to permission denied page if user is not a SuperAdmin
            $this->view("Admin/403PermissionDenied");
        }
    }
}