<?php
namespace App\controllers;
use App\core\Controller;
class FeedbackHistory
{
    use Controller;

    public function index()
    {
        $data = null;
        echo "<script>console.log('testingjwhbf');</script>";
        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Feedback/FeedbackHistory', $data);
    }
}


