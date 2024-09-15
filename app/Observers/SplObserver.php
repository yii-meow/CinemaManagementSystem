<?php
//SplObserver

namespace App\Observers;


interface SplObserver {
    public function update(SplSubject $subject);
}
?>
