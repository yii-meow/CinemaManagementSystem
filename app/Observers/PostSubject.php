<!--Concrete Subject
- maintain the state that other obj are interested in (Eg. num of like)
-->
<?php

class PostSubject implements SplSubject
{
    private $observers = [];
    private $like; // The like count
    private $comments = []; // Array of comments
    private $replies = []; // Array of replies

    // Attach an observer
    public function attach(Forum $observer)
    {
        $this->observers[] = $observer;
    }

    // Detach an observer
    public function detach(Forum $observer)
    {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    // Notify all observers
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    // Like-related functionality
    public function getLike()
    {
        return $this->like;
    }

    public function setLike($like)
    {
        $this->like = $like;
        $this->notify();
    }

    // Comment-related functionality
    public function addComment($comment)
    {
        $this->comments[] = $comment;
        $this->notify();
    }

    public function getComments()
    {
        return $this->comments;
    }

    // Reply-related functionality
    public function addReply($commentId, $reply)
    {
        $this->replies[$commentId][] = $reply;
        $this->notify();
    }

    public function getReplies()
    {
        return $this->replies;
    }
}
?>
