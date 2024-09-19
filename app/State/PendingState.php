<?php
namespace App\State;
use App\models\Feedback;
use App\constant\feedback_status;

class PendingState implements FeedbackState {
    // pending -> in progress
    public function proceed(Feedback $feedback) {

        //if original status is pending
        //set to in progress
        if($feedback->getStatus() == feedback_status::PENDING){
            $feedback->setStatus(feedback_status::IN_PROGRESS);
        }else{
            return false;
            //$feedback->setStatus(new InProgressState());
        }
        return true;
    }

    public function problemSolved(Feedback $feedback) {
        echo "Cannot offer compensation. Feedback is still being worked on.\n";
    }

    public function offerCompensation(Feedback $feedback) {
        echo "Cannot offer compensation. Feedback is still pending.\n";
    }
}
