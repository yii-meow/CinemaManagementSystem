<?php

namespace App\controllers;

use App\models\Reward;
use App\core\Controller;
use App\core\Database;

class RewardManage
{
    use Controller;

    private $entityManager;
    private $rewardRepository;

    public function __construct()
    {
        // Initialize EntityManager and Reward repository
        $this->entityManager = Database::getEntityManager();
        $this->rewardRepository = $this->entityManager->getRepository(Reward::class);
    }

    public function index()
    {
        // Check if the request method is POST to handle the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addReward') {
            // Retrieve form data
            $rewardTitle = $_POST['rewardTitle'];
            $category = $_POST['category'];
            $details = $_POST['details'];
            $description = $_POST['description'];
            $qty = $_POST['qty'];
            $neededCoins = $_POST['neededCoins'];

            // Handle file upload
            if (isset($_FILES['rewardImage']) && $_FILES['rewardImage']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'C:/xampp/htdocs/CinemaManagementSystem/public/assets/images/';
                $uploadFile = $uploadDir . basename($_FILES['rewardImage']['name']);

                if (move_uploaded_file($_FILES['rewardImage']['tmp_name'], $uploadFile)) {
                    $rewardImg = basename($_FILES['rewardImage']['name']);
                } else {
                    // Handle file upload error
                    $rewardImg = 'default.png'; // Set a default image if upload fails
                }
            } else {
                $rewardImg = 'default.png'; // Set a default image if no file is uploaded
            }

            // Create a new Reward instance
            $reward = new Reward();
            $reward->setRewardTitle($rewardTitle);
            $reward->setCategory($category);
            $reward->setDetails($details);
            $reward->setDescription($description);
            $reward->setQty($qty);
            $reward->setNeededCoins($neededCoins);
            $reward->setRewardImg($rewardImg);

            // Persist the reward to the database
            $this->entityManager->persist($reward);
            $this->entityManager->flush();
        }

        // Check if a search query is provided
        $search = $_GET['search'] ?? '';

        if ($search) {
            // Filter rewards based on the search query
            $qb = $this->entityManager->createQueryBuilder();
            $qb->select('r')
                ->from(Reward::class, 'r')
                ->where($qb->expr()->orX(
                    $qb->expr()->like('r.rewardTitle', ':search'),
                    $qb->expr()->like('r.category', ':search'),
                    $qb->expr()->like('r.details', ':search'),
                    $qb->expr()->like('r.description', ':search')
                ))
                ->setParameter('search', '%' . $search . '%');
            $rewards = $qb->getQuery()->getResult();
        } else {
            // Fetch all rewards from the database
            $rewards = $this->rewardRepository->findAll();
        }

        // Pass the list of rewards to the view
        $data = [
            'rewards' => $rewards,
            'search' => $search  // To keep search input visible after search
        ];

        // Render the RewardManage view with the reward data
        $this->view('Admin/User/RewardManage', $data);

    }
}