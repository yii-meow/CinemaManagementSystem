<!--Concrete Observer
- perform a concrete action when notified (Eg. update UI)
-->
<?php

class LikeObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        if ($subject instanceof PostSubject) {
            echo "LikeObserver: The post now has " . $subject->getLike() . " likes.\n";
        }
    }
}
?>
