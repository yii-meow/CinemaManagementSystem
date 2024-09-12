<?php

class Feedback
{
    use Controller;

    public function index()
    {
        $data = null;
        echo "<script>console.log('show feedback index');</script>";
        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Feedback/Feedback', $data);
    }

    public function submit(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<script>console.log('submit feedback');</script>";

            //temp user, should use from session user id
            $userID = 1;

            $content = $_POST['content'];
            $rating =  $_POST['stars'];

            $message = "Feedback submit successful!";
            echo "<script type='text/javascript'>alert('$message');</script>";

            $data = null;
            $this->view('Customer/Feedback/Feedback', $data);
        }
    }
}

