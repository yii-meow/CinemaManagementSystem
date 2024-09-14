<!-- Observer
- receive update from subject, update the observer
-->
<?php
interface SplObserver
{
    public function update(SplSubject $subject);
}
?>