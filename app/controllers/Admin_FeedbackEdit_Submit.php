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

class Admin_FeedbackEdit_Submit{

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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $success = false;
            $feedbackID = $_POST['feedbackID'];

            if ($_POST['reply']) {
                $reply = $_POST['reply'];
            } else {
                $reply = null;
            }

            if (isset($_POST['coinCompensation'])) {
                $coinCompensation = $_POST['coinCompensation'];
            } else {
                $coinCompensation = null;
            }

            $feedback = $this->feedbackRepository->findBy(['feedbackID' => $feedbackID]);
            $data = $feedback;

            if($coinCompensation){
                $feedback[0]->setCoinCompensation($coinCompensation);
            }

            if(isset($_POST['status']) && ($_POST['status'] != $feedback[0]->getStatus())){
                $status = $_POST['status'];
                //echo "changing status";

                if(($feedback[0]->getStatus() == feedback_status::PENDING) && ($status == feedback_status::IN_PROGRESS)){
                    //pending -> in progress
                    $feedbackState = new Feedback(new PendingState());
                    $success = $feedbackState->proceed($feedback[0]);
                    //echo "valid option";
                } elseif (($feedback[0]->getStatus() == feedback_status::IN_PROGRESS) && ($status == feedback_status::RESOLVED)){
                    //in progress -> resolved
                    $feedbackState = new Feedback(new InProgressState());
                    $success = $feedbackState->problemSolved($feedback[0]);
                    //echo "valid option";
                } elseif (($feedback[0]->getStatus() == feedback_status::IN_PROGRESS) && ($status == feedback_status::COMPENSATION_OFFERED)){
                    //in progress -> compensation offered
                    $feedbackState = new Feedback(new InProgressState());
                    $success = $feedbackState->offerCompensation($feedback[0]);
                    //echo "valid option";
                } elseif (($feedback[0]->getStatus() == feedback_status::RESOLVED) && ($status == feedback_status::COMPENSATION_OFFERED)){
                    //resolved ->  compensation offered
                    $feedbackState = new Feedback(new ResolvedState());
                    $success = $feedbackState->offerCompensation($feedback[0]);
                    //echo "valid option";
                } else{

                    $message = "Invalid status option!";
                    //echo "<script type='text/javascript'>alert('$message');</script>";

                }

            }elseif (!isset($_POST['status']) && ($feedback[0]->getStatus() == feedback_status::COMPENSATION_OFFERED)){
                //status at compensation offered
                $success = true;
            }elseif($_POST['status'] == $feedback[0]->getStatus()){
                //status no change
                $success = true;
        }

            if($success){
                $feedback = $this->feedbackRepository->find($feedbackID);
                //$feedback->setStatus($status);
                $feedback->setReply($reply);

                //if coin compensation is not empty, status = coin compensation offered
                if($coinCompensation){
                    $feedback->setStatus(feedback_status::COMPENSATION_OFFERED);
                }

                try {
                    $this->entityManager->flush();

                    //memory management
                    unset($feedback, $status, $reply);
                    $this->entityManager = null; // Free the entity manager

                    header('Location: ' . ROOT . '/Admin_FeedbackIndex');
                    exit;
                } catch (\Exception $e) {
                    error_log($e->getMessage());
                    echo $e->getMessage();
                    exit;
                }
            }else{
                $data['error'] = 'Invalid status flow.';

                //$this->index();
                //$this->index($data);
                $this->view('Admin/Feedback/Feedback_edit', $data);
                exit;
            }


        }
    }
}

