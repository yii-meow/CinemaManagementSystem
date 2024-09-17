<?php
namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\Feedback;

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

    public function index()
{
    $feedback = $this->feedbackRepository->findBy(['feedbackID' => $_GET['feedbackID']]);

    $data = $feedback;

    //print_r($feedback);
    //die();


    //get selected feedback record
    //Route to the destinaiton page, with passing data from the Model
    $this->view('Admin/Feedback/Feedback_edit', $data);
}

    public function submit()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $feedbackID = $_POST['feedbackID'];
            $status = $_POST['status'];

            if ($_POST['reply']) {
                $reply = $_POST['reply'];
            } else {
                $reply = null;
            }

            if ($_POST['coinCompensation']) {
                $coinCompensation = $_POST['coinCompensation'];
            } else {
                $coinCompensation = null;
            }

            //echo $reply;
            //echo $coinCompensation;
            //die();

            $feedback = $this->feedbackRepository->find($feedbackID);
            $feedback->setStatus($status);
            $feedback->setCoinCompensation($coinCompensation);
            $feedback->setReply($reply);

            try {
                $this->entityManager->flush();

                //$this->sendEmail();

                //got some error here haha
                //go back to feedback module index
                $feedbackIndex = new Admin_FeedbackIndex();
                $feedbackIndex->index();
                exit;
            } catch (\Exception $e) {
                error_log($e->getMessage());
                echo $e->getMessage();
                exit;
            }


        }
    }
}

