<?php
namespace App\State;
use App\models\Feedback;

class CompensationOfferedState implements FeedbackState {
    public function proceed(Feedback $feedback) {
        echo "End of state.\n";
    }

    public function problemSolved(Feedback $feedback) {
        echo "End of state.\n";
    }

    public function offerCompensation(Feedback $feedback) {
        echo "Compensation already offered.\n";
    }
}
