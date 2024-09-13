<?php

class Admin_FeedbackEdit
{
    use Controller;

    public function index()
    {
        $feedback = null;
        $feedback['userID'] = "3";
        $feedback['content'] = "123gygwegfiwey";
        $feedback['rating'] = "3";
        $feedback['date'] = "12/12/2025";
        $feedback['status'] = "unread";
        $feedback['reply'] = "dshgiwdgifyiwe";
        $feedback['coinCompensation'] = "100";
        $data = $feedback;

        //get selected feedback record

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Admin/Feedback/Feedback_edit', $data);
    }

    public function submit()
    {
        $data = null;
        $this->view('Admin/Feedback/Feedback_index', $data);
    }
}

