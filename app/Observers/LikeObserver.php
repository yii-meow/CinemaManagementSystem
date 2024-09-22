<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\Observers;

use App\Observers\Subject;
use App\models\Post;

// respond to changes by updating the like count or sending a notification when a post is liked or unliked.

class LikeObserver extends Observer {

    public function update(string $action, $post, $user): void {
        $likeCount = $post->getLikes()->count();

        $message = ($action === 'like')
            ? "Post liked by user. New like count: $likeCount."
            : "Post unliked by user. New like count: $likeCount.";

        error_log($message);
    }

}


