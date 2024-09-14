<!--Subject
- object that frequently change and wants to be observed
- attach, detach, and notify observer
-->
<?php
interface SplSubject
{
public function attach(SplObserver $observer);
public function detach(SplObserver $observer);
public function notify();
}
?>

