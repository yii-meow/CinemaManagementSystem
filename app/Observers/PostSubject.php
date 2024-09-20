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


   public function __construct() {
        $this->entityManager = Database::getEntityManager();
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
    }
    public function attach(ObserverInterface $observer): void {
        $this->observers[] = $observer;
    }
    public function detach(ObserverInterface $observer): void {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    public function notifyAllObservers(string $event, ?Post $post = null, ?User $user = null): void {
        foreach ($this->observers as $observer) {
            $observer->update($event, $post, $user);
        }
    }


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
            $like = new Likes();
            $like->setLikedBy($user);
            $like->setPost($post);
            $like->setLikeDate(new \DateTime());
            $this->entityManager->persist($like);
            $isLiked = true;
        }

        $this->entityManager->flush();
        $this->notifyAllObservers($isLiked ? 'like' : 'unlike', $post, $user);    }

    // Method to check whether a post is liked
    public function isLiked(User $user, Post $post): bool
    {
        $existingLike = $this->likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);
        return $existingLike !== null;
    }

    public function addComment(User $user, Post $post, string $commentText): void {
       try{
       $comment = new Comment();
        $comment->setPost($post);
        $comment->setCommenter($user);
        $comment->setCommentText($commentText);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

           $this->notifyAllObservers('comment', $post, $user);
           header('Location: ' . ROOT . '/Forum?message=comment_success');
       } catch (\Exception $e) {
           header('Location: ' . ROOT . '/Forum?message=comment_fail');
       }
    }

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
            header('Location: ' . ROOT . '/Forum?message=reply_success');
        } catch (\Exception $e) {
            header('Location: ' . ROOT . '/Forum?message=reply_fail');
        }
    }

}
