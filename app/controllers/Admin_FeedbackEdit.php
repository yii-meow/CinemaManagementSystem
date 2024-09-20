<?php
namespace App\controllers;

use App\constant\feedback_status;
use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\Feedback;
use App\State\CompensationOfferedState;
use App\State\FeedbackState;
use App\State\InProgressState;
use App\State\PendingState;
use App\State\ResolvedState;

class Admin_FeedbackEdit{

    use Controller;

    private $entityManager;
    private $feedbackRepository;
    public function __construct()
{
    $this->entityManager = Database::getEntityManager();
    $this->feedbackRepository = $this->entityManager->getRepository(Feedback::class);
    $this->userRepository = $this->entityManager->getRepository(User::class);
}

    public function index($ori_data = null)
{
    $feedback = $this->feedbackRepository->findBy(['feedbackID' => $_GET['feedbackID']]);

    $data = $feedback;

    if(isset($ori_data)){
        $data = $ori_data;
    }

    //memory management
    unset($feedback);
    //get selected feedback record
    //Route to the destinaiton page, with passing data from the Model
    $this->view('Admin/Feedback/Feedback_edit', $data);
}

}

