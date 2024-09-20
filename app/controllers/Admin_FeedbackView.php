<?php
namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\Feedback;

class Admin_FeedbackView
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
        $feedback = $this->feedbackRepository->findBy(['feedbackID' => $_GET['feedbackID']]);

        $data = $feedback;

        //print_r($feedback);
        //echo $feedback[0]->getCreatedAt()->format('Y-m-d');
        //echo is_null($feedback[0]->getInProgressAt());
        //echo $feedback[0]->getResolvedAt()->format('Y-m-d');
        //echo $feedback[0]->getCompensationOfferedAt()->format('Y-m-d');
        //die();


        //get selected feedback record
        //Route to the destinaiton page, with passing data from the Model
        $this->view('Admin/Feedback/Feedback_view', $data);
    }
}
