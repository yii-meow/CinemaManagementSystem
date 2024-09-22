<?php
namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\Feedback;
use App\constant\feedback_status;
use App\State\PendingState;

class FeedbackController
{
    use Controller;

    private $entityManager;
    private $feedbackRepository;
    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->feedbackRepository = $this->entityManager->getRepository(Feedback::class);
    }

    public function index()
    {
        $data = null;
        echo "<script>console.log('show feedback index');</script>";
        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Feedback/Feedback', $data);
    }

    public function submit(){

        // Start session if not started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
           // Redirect to login if userId is not set
           header('Location: ' . ROOT . '/Login');
           exit();
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<script>console.log('submit feedback');</script>";

            //temp user, should use from session user id
            $userID = $_SESSION['userId'];
            $content = $_POST['content'];
            $rating =  $_POST['stars'];
            $status = feedback_status::PENDING;

            $feedback = new Feedback(new PendingState());
            $feedback->setUser($this->entityManager->getRepository(User::class)->find($userID))->setContent($content)->setRating($rating)->setStatus($status)->setCreatedAt(new \DateTime());
            $feedback->setReply(null)->setCoinCompensation(null);

            try {
                $this->entityManager->persist($feedback);
                $this->entityManager->flush();

                //$this->sendEmail();

                header('Location: ' . ROOT . '/FeedbackController');
                exit;
            } catch (\Exception $e) {
                error_log($e->getMessage());
                echo $e->getMessage();
                exit;
            }


        }
    }

}

