<?php
namespace App\Observers;

use App\Observers\Subject;

class Like extends Subject{
//concrete subject that tracks the likes on posts and notifies the observers.
    //setter, setter
    private $post;
    private $likedBy;
    private $likeDate;

    public function getPost() {
        return $this->post;
    }

    public function getLikedBy() {
        return $this->likedBy;
    }

    public function getLikeDate() {
        return $this->likeDate;
    }

    public function setLike($post,$likedBy,$likeDate) {
        $this->post = $post;
        $this->likedBy = $likedBy;
        $this->likeDate = $likeDate;
        $this->notifyAllObservers(); // call to the subject
    }
}
?>

