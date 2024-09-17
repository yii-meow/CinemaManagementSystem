<?php
namespace App\controllers;


use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\Feedback;

class Admin_FeedbackIndex
{
    use Controller;

    private $entityManager;
    private $feedbackRepository;
    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->feedbackRepository = $this->entityManager->getRepository(Feedback::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }
    public function index()
    {
        $feedback = $this->feedbackRepository->findAll();

        $data = $feedback;

        //print_r(count($feedback)) ;
        //die();

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Admin/Feedback/Feedback_index', $data);
    }
}

