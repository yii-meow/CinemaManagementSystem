<?php
namespace App\Observers;

use SplObserver;
use SplSubject;
use Doctrine\ORM\EntityManagerInterface;
use App\models\Comment;

class CommentObserver implements SplObserver
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(SplSubject $subject)
    {
        if ($subject instanceof Comment) {
            $this->updateComment($subject);
        }
    }

    private function updateComment(Comment $comment)
    {
        // Example: Update the comment count for the associated post
        $post = $comment->getPost();
        $postId = $post->getPostID();

        // Fetch the updated comment count
        $commentCount = $this->entityManager->getRepository(Comment::class)
            ->count(['post' => $post]);

        // Update the post entity with the new comment count (pseudo-code)
        $post->setCommentCount($commentCount);
        $this->entityManager->flush();
    }
}
?>