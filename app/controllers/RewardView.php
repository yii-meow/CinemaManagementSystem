<?php

namespace App\controllers;

use App\models\Reward;
use App\core\Controller;
use App\core\Database;

class RewardView
{
    use Controller;

    private $entityManager;
    private $rewardRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->rewardRepository = $this->entityManager->getRepository(Reward::class);
    }

    public function index()
    {
        if (isset($_SESSION['admin'])){

            $action = $_POST['action'] ?? null;
        $rewardId = $_GET['rewardId'] ?? $_POST['rewardId'] ?? null;

        if ($action === 'update') {
            $this->updateReward($rewardId);
        } elseif ($action === 'delete') {
            $this->deleteReward($rewardId);
        } else {
            $this->viewReward($rewardId);
        }

        }else {
            // Redirect to permission denied page if user is not a SuperAdmin
            $this->view("Admin/403PermissionDenied");
        }
    }

    private function viewReward($rewardId): void
    {
        if ($rewardId) {
            $reward = $this->rewardRepository->find($rewardId);

            if ($reward) {
                $data = [
                    'reward' => $reward
                ];
                $this->view('Admin/User/RewardView', $data);
            } else {
                echo "Reward not found.";
            }
        } else {
            echo "No reward ID provided.";
        }
    }

    private function updateReward($rewardId): void
    {
        if ($rewardId) {
            $reward = $this->rewardRepository->find($rewardId);

            if ($reward) {
                $reward->setRewardTitle($_POST['rewardTitle'] ?? $reward->getRewardTitle());
                $reward->setCategory($_POST['category'] ?? $reward->getCategory());
                $reward->setDetails($_POST['details'] ?? $reward->getDetails());
                $reward->setDescription($_POST['description'] ?? $reward->getDescription());
                $reward->setQty($_POST['qty'] ?? $reward->getQty());
                $reward->setNeededCoins($_POST['neededCoins'] ?? $reward->getNeededCoins());

                if (isset($_FILES['rewardImage']) && $_FILES['rewardImage']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'C:/xampp/htdocs/CinemaManagementSystem/public/assets/images/';
                    $uploadFile = $uploadDir . basename($_FILES['rewardImage']['name']);

                    if (move_uploaded_file($_FILES['rewardImage']['tmp_name'], $uploadFile)) {
                        $reward->setRewardImg(basename($_FILES['rewardImage']['name']));
                    }
                }

                $this->entityManager->persist($reward);
                $this->entityManager->flush();

                // Fetch all rewards from the database
                $rewards = $this->rewardRepository->findAll();

                // Pass the list of rewards to the view
                $data = [
                    'rewards' => $rewards
                ];

                // Render the RewardManage view with the reward data
                $this->view('Admin/User/RewardManage', $data);
                exit();
            } else {
                echo "Reward not found.";
            }
        } else {
            echo "No reward ID provided.";
        }
    }

    private function deleteReward($rewardId): void
    {
        if ($rewardId) {
            $reward = $this->rewardRepository->find($rewardId);

            if ($reward) {
                $this->entityManager->remove($reward);
                $this->entityManager->flush();

                // Fetch all rewards from the database
                $rewards = $this->rewardRepository->findAll();

                // Pass the list of rewards to the view
                $data = [
                    'rewards' => $rewards
                ];

                // Render the RewardManage view with the reward data
                $this->view('Admin/User/RewardManage', $data);
                exit();
            } else {
                echo "Reward not found.";
            }
        } else {
            echo "No reward ID provided.";
        }
    }
}