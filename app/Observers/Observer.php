<?php
//Observer
namespace App\Observers;

abstract class Observer {

    protected $subject; //  hold a reference

 public function __construct(Subject $subject) {
        $this->subject = $subject;
    }
    public abstract function update(Subject $subject): void; // update the observer with new data
}

?>
