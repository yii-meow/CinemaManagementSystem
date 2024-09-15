<?php
namespace App\Observers;

use SplObserver;
use SplSubject;
use Doctrine\ORM\EntityManagerInterface;
use App\models\Likes;

class LikeObserver implements SplObserver
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(SplSubject $subject)
    {
        if ($subject instanceof Likes) {
            $this->updateLike($subject);
        }
    }

    private function updateLike(Likes $like)
    {
        // Example: Update the like count for the associated post
        $post = $like->getPost();
        $postId = $post->getPostID();

        // Fetch the updated like count
        $likeCount = $this->entityManager->getRepository(Likes::class)
            ->count(['post' => $post]);

        // Update the post entity with the new like count (pseudo-code)
        $post->setLikeCount($likeCount);
        $this->entityManager->flush();
    }
}

?>
