<?php
namespace App\State;
use App\constant\feedback_status;
use App\models\Feedback;

class ResolvedState implements FeedbackState {
    public function proceed(Feedback $feedback) {
        echo "can not go back to proceed.\n";
    }

    public function problemSolved(Feedback $feedback) {
        echo "Cannot offer compensation. Feedback is still being worked on.\n";
    }


    public function offerCompensation(Feedback $feedback) {
        if($feedback->getStatus() == feedback_status::RESOLVED){
            $feedback->setStatus(feedback_status::COMPENSATION_OFFERED);
            $feedback->setCompensationOfferedAt(new \DateTime());

            //update coin
            $compensation_coin = $feedback->getCoinCompensation();
            $user = $feedback->getUser();

            if ($compensation_coin > 0) {
                $current_coin = $user->getCoins();
                $new_coin_balance = $current_coin + $compensation_coin;

                // Set new coin balance
                $user->setCoins($new_coin_balance);

            } else {
                echo "Invalid compensation amount.";
            }
        }else{
            return false;
            //$feedback->setStatus(new InProgressState());
        }
        return true;
    }
}