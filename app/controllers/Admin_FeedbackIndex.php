<?php
namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\Feedback;
use App\services\ExtractKeywordAPI\requestTopicTaggingAPI;

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

        $data['feedback'] = $feedback;

        //for each feedback array and store keyword in another array and put into $data
        $keyword = new requestTopicTaggingAPI();

        $arr = [];

        foreach ($data['feedback'] as $feedback){

            $keyword_array = json_decode($keyword->requestAPI($feedback->getContent()), true);
            $arr[] = $keyword_array;
        }

        $data['keyword'] = $arr;

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Admin/Feedback/Feedback_index', $data);
    }

    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data using the $_POST superglobal array

            $rating = $_POST['filter_rating'];
            $status = $_POST['filter_status'];

            //get record by keyword provided
            $feedback = $this->feedbackRepository->findAll();

            $data = $feedback;
        }

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Admin/Feedback/Feedback_index', $data);
    }
}

