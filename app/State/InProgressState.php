<?php
namespace App\State;
use App\constant\feedback_status;
use App\models\Feedback;

class InProgressState implements FeedbackState {

    public function proceed(Feedback $feedback) {
        echo "in progress cannot go back to pending";
    }

    public function problemSolved(Feedback $feedback) {

        if($feedback->getStatus() == feedback_status::IN_PROGRESS){
            $feedback->setStatus(feedback_status::RESOLVED);
        }else{
            return false;
            //$feedback->setStatus(new InProgressState());
        }
        return true;
    }

    public function offerCompensation(Feedback $feedback) {
        if($feedback->getStatus() == feedback_status::IN_PROGRESS){
            $feedback->setStatus(feedback_status::COMPENSATION_OFFERED);
        }else{
            return false;
            //$feedback->setStatus(new InProgressState());
        }
        return true;
    }
}