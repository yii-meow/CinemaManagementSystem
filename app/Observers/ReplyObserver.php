<?php
namespace App\Observers;

use SplObserver;
use SplSubject;
use Doctrine\ORM\EntityManagerInterface;
use App\models\Reply;

class ReplyObserver implements SplObserver
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(SplSubject $subject)
    {
        if ($subject instanceof Reply) {
            $this->updateReply($subject);
        }
    }

    private function updateReply(Reply $reply)
    {
        // Example: Perform actions related to replies
        // This could be updating a reply count or any other action you need
        $comment = $reply->getComment();
        $commentId = $comment->getCommentID();

        // Handle the reply update (pseudo-code)
        $replyCount = $this->entityManager->getRepository(Reply::class)
            ->count(['comment' => $comment]);

        // Update the comment entity with the new reply count (pseudo-code)
        $comment->setReplyCount($replyCount);
        $this->entityManager->flush();
    }
}

?>
