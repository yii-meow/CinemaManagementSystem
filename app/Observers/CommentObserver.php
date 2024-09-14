<!--Concrete Observer-->
<?php

class CommentObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        if ($subject instanceof PostSubject) {
            echo "CommentObserver: There are now " . count($subject->getComments()) . " comments.\n";
        }
    }
}
?>