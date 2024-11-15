<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\Observers;

use App\models\Likes;
use App\models\Post;
use App\models\User;
use App\core\Database;

class LikeSubject extends Subject {

    private $likeRepository;
    private $entityManager;

    public function __construct() {
        $this->entityManager = Database::getEntityManager();
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
    }

    // 6 Check whether the user action is like or unlike the post
    public function likePost(User $user, Post $post): void {
        // Check whether the user liked a specific post
        $existingLike = $this->likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);

        // If liked
        if ($existingLike) {
            // The user is unliking the post
            $this->entityManager->remove($existingLike);
            $isLiked = false; // now unliked
        } else {
            // The user is liking the post
            $like = new Likes();
            $like->setLikedBy($user);
            $like->setPost($post);
            $like->setLikeDate(new \DateTime());
            $this->entityManager->persist($like);
            $isLiked = true;
        }

        // save changes to DB
        $this->entityManager->flush();

        // 7 Notify all observers about the state change
        $this->notifyAllObservers($isLiked ? 'like' : 'unlike', $post, $user);
    }

    public function isLiked(User $user, Post $post): bool {
        $existingLike = $this->likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);
        return $existingLike !== null;
    }
}
