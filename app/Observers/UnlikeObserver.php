<?php
namespace App\Observers;

use App\models\Likes;

class UnlikeObserver extends Observer
{
    public function update(Subject $subject): void {
        if ($subject instanceof Likes) {
            $post = $subject->getPost();
            $likeCount = $post->getLikes()->count();

            // Perform business logic for 'unlike'
            echo "UnlikeObserver: Post has been unliked. New like count: $likeCount.";
        }
    }
}
?>
