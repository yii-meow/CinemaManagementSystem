<?php

class Admin_FeedbackIndex
{
    use Controller;

    public function index()
    {
        $data = null;

        //get all feedback record

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Admin/Feedback/Feedback_index', $data);
    }
}

