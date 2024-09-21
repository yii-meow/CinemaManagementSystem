<?php
namespace App\Observers;

use App\core\Database;
use App\models\Comment;
use App\models\Likes;
use App\models\Reply;
use App\models\User;
use App\models\Post;

////concrete subject that tracks the likes on posts and notifies the observers.
class PostSubject implements SubjectInterface { // implemenmt the Subject

    private $observers = []; // collection of data
    private $entityManager;
    private $likeRepository;

    // Constructor to initialize the subject and its repositories
   public function __construct() {
        $this->entityManager = Database::getEntityManager();
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
    }

    // Attach an observer to the subject
    public function attach(ObserverInterface $observer): void {
        $this->observers[] = $observer;// Add observer to the list
    }
    public function detach(ObserverInterface $observer): void {
        // Filter out the given observer from the list
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    // Notify all observers about an event
    public function notifyAllObservers(string $event, Post $post = null, User $user = null): void {
        // Loop through each observer and call their update method
        foreach ($this->observers as $observer) {
            $observer->update($event, $post, $user);
        }
    }


    // Method to handle liking or unliking a post
    public function likePost(User $user, Post $post): void {
        // check whether the user liked a specific post
        $existingLike = $this->likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);

        // if liked
        if ($existingLike) {
            // means the user is unliking the post
            $this->entityManager->remove($existingLike);
            $isLiked = false; // the like status become unliked ady

        } else {
            // means the user is liking the post
            try {
                $like = new Likes();
                $like->setLikedBy($user);
                $like->setPost($post);
                $like->setLikeDate(new \DateTime());
                $this->entityManager->persist($like);
                $isLiked = true;
            }catch(\Exception $e){
                error_log('Error adding like: ' . $e->getMessage());
                exit();
            }
        }

        $this->entityManager->flush(); // Save changes to the database
        // Notify observers about the like/unlike event
        $this->notifyAllObservers($isLiked ? 'like' : 'unlike', $post, $user);
   }

    // Method to check whether a post is liked
    public function isLiked(User $user, Post $post): bool
    {
        $existingLike = $this->likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);
        return $existingLike !== null;
    }

    // Method to add a comment to a post
    public function addComment(User $user, Post $post, string $commentText): void {
       try {
           $comment = new Comment();
           $comment->setPost($post);
           $comment->setCommenter($user);
           $comment->setCommentText($commentText);

           $this->entityManager->persist($comment);
           $this->entityManager->flush();

           $this->notifyAllObservers('comment', $post, $user);
       }catch(\Exception $e){
           error_log('Error adding comment: ' . $e->getMessage());
           exit();
        }
    }

    // Method to add a reply to a comment
    public function addReply(User $user, Comment $comment, string $replyText): void
    {
        try {
            $reply = new Reply();
            $reply->setComment($comment);
            $reply->setUserReply($user);
            $reply->setReplyText($replyText);

            $this->entityManager->persist($reply);
            $this->entityManager->flush();

            $this->notifyAllObservers('reply', $comment->getPost(), $user);
        }catch(\Exception $e){
            error_log('Error adding reply: ' . $e->getMessage());
            exit();
        }

    }

}
