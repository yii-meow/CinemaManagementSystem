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
            $feedback->setResolvedAt(new \DateTime());
        }else{
            return false;
            //$feedback->setStatus(new InProgressState());
        }
        return true;
    }

    public function offerCompensation(Feedback $feedback) {
        if($feedback->getStatus() == feedback_status::IN_PROGRESS){
            $feedback->setStatus(feedback_status::COMPENSATION_OFFERED);
            $feedback->setResolvedAt(new \DateTime());
            $feedback->setCompensationOfferedAt(new \DateTime());

            //update coin
            $compensation_coin = $feedback->getCoinCompensation();
            $user = $feedback->getUser();

            if ($compensation_coin > 0) {
                $current_coin = $user->getCoins();
                $new_coin_balance = $current_coin + $compensation_coin;

                // Set new coin balance
                $feedback->getUser()->setCoins($new_coin_balance);


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