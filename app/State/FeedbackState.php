<?php
namespace App\State;
use App\constant\feedback_status;
use App\models\Feedback;

//generated   set by user    set by user        if compensation is offer, auto proceed
//pending -> in progress -> resolved                            ----> end
//                       -> compensation offered -> resolved    -----> end
interface FeedbackState {
    public function proceed(Feedback $feedback);


    public function problemSolved(Feedback $feedback);

    //in progress -> offer
    //resolve -> offer
    public function offerCompensation(Feedback $feedback);
}
