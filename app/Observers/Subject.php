<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\Observers;

abstract class Subject {

    private $observers= []; // to hold a collection of observers

    function __construct() {
        $this->observers = [];
    }

    // 3 add observer to the list
    public function attach(Observer $observer) {
        $this->observers[] = $observer;  // LikeObserver is now registered with LikeSubject
        // when a post is liked or unliked it will be notified
    }

    public function detach(Observer $observer): void {// remove the observer
        foreach ($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    // 8 notify each observer of like or unlike action
    public function notifyAllObservers(string $action, $post, $user): void {
        foreach ($this->observers as $observer) { // loop througgh all attached observers
            $observer->update($action, $post, $user); // call the update and pass in the action, user and post data
        }
    }
}






