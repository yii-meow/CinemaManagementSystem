<?php
/**
 * Author: Chong Kah Yan
 */
namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;

class UserManage
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
        if (isset($_SESSION['admin'])){

            $searchQuery = $_GET['search'] ?? null; // Get the search query from the URL

        // If a search query is provided, filter users based on it
        if ($searchQuery) {
            // Create a query to search users by username, phone number, or email
            $qb = $this->entityManager->createQueryBuilder();
            $qb->select('u')
                ->from(User::class, 'u')
                ->where('u.userName LIKE :search')
                ->orWhere('u.phoneNo LIKE :search')
                ->orWhere('u.email LIKE :search')
                ->setParameter('search', '%' . $searchQuery . '%');

            $users = $qb->getQuery()->getResult();
        } else {
            // Fetch all users from the database if no search query is provided
            $users = $this->userRepository->findAll();
        }

        // Pass the list of users and search query to the view
        $data = [
            'users' => $users,
            'searchQuery' => $searchQuery
        ];

        // Render the UserManage view with the user data
        $this->view('Admin/User/UserManage', $data);

        }else {
            // Redirect to permission denied page if user is not a SuperAdmin
            $this->view("Admin/403PermissionDenied");
        }
    }
}