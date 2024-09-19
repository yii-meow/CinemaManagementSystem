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
        //if (session_status() == PHP_SESSION_NONE) {
        //    session_start();
        //}

        // Check if userId is set in the session
        //if (!isset($_SESSION['userId'])) {
        //    // Redirect to login if userId is not set
        //    header('Location: ' . ROOT . '/Login');
        //    exit();
        //}

        //$userId = $_SESSION['userId'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<script>console.log('submit feedback');</script>";

            //temp user, should use from session user id
            $userID = 1;
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

    public function sendEmail(){
        // API URL
        $apiUrl = 'https://api.resend.com/emails';

        // Your API Key
        $apiKey = 're_L4dUybcu_A9RyPxvfAfAd35SF6pjFtQpW';

        // Email data
        $data = [
            'from' => 'leonardloh08@gmail.com',
            'to' => 'leonardlhw-wm21@student.tarc.edu.my',
            'subject' => 'Test Email',
            'html' => '<strong>Hello, this is a test email!</strong>',
        ];

        // Initialize cURL
        $ch = curl_init($apiUrl);

        // Set options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ]);

        // Execute cURL request and get the response
        $response = curl_exec($ch);

        // Close cURL
        curl_close($ch);

        // Check for errors
        if ($response === false) {
            die('Error sending email: ' . curl_error($ch));
        }

        echo 'Email sent successfully: ' . $response;

    }
}

