<?php
namespace App\controllers;


use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\Feedback;

class FeedbackHistory
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
        //temp user, should use from session user id
        $userID = 1;

        $user = $this->userRepository->find($userID);

        $feedback = $this->feedbackRepository->findBy(['user' => $user]);

        $data = $feedback;

        //print_r(count($feedback)) ;
        //die();

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Feedback/FeedbackHistory', $data);
    }
}


