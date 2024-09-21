<?php
namespace App\Observers;

use App\models\Comment;
use App\models\Post;
use App\models\User;
use App\Observers\ObserverInterface;

// respond to changes by updating the like count


class LikeObserver implements ObserverInterface {
    public function update(string $event, Post $post = null, User $user = null, Comment $comment = null, string $replyText = null): void {
        /*if ($event === 'like' || $event === 'unlike') {
            //$this->updateLikeCount($post);
            echo $user->getUserName() . " " . ($event === 'like' ? "liked" : "unliked") . " the post: " . $post->getContent() . "\n";
        }*/
    }

}
