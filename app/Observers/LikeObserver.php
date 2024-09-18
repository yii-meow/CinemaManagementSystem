<?php
namespace App\Observers;


class LikeObserver extends Observer
{
    // respond to changes by updating the like count or sending a notification when a post is liked or unliked.

    public function update(Subject $subject): void {
        if ($subject instanceof Like) {
            $post = $subject->getPost();
            $likeCount = $post->getLikes()->count();
            show($likeCount);
            // Return the updated like count and status to the controller
            /*$isLiked = true; // liked the icon
            $this->subject->notify(['likeCount' => $likeCount, 'isLiked' => $isLiked]);*/
            echo "LikeObserver: Post liked. New like count: $likeCount.";

        }
    }
}
?>

