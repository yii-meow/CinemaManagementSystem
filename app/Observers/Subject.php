<?php

namespace App\Observers;
use SplObjectStorage;

abstract class Subject {

    private $observers= []; // to hold a collection of observers

    function __construct() {
        $this->observers = [];
    }

    public function attach(Observer $observer) {
        $this->observers[] = $observer; // add observer to the list
    }

    public function detach(Observer $observer): void {// remove the observer
        foreach ($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    // Both like and unolike observer are notified
    public function notifyAllObservers(): void {
        foreach ($this->observers as $observer) {//notify all attached observer
            $observer->update($this); // call the observer update method
        }
    }
}



