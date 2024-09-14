<!--Concrete Observer-->
<?php

class ReplyObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        if ($subject instanceof PostSubject) {
            $replies = $subject->getReplies();
            foreach ($replies as $commentId => $replyList) {
                echo "ReplyObserver: Comment ID $commentId has " . count($replyList) . " replies.\n";
            }
        }
    }
}
?>