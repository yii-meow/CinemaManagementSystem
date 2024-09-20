<?php
namespace App\Observers;

use App\core\Database;
use App\models\Post;
use App\models\User;
use App\models\Comment;
use App\models\Reply;

class ReplyObserver implements ObserverInterface {
    private $entityManager;

    public function __construct() {
        $this->entityManager = Database::getEntityManager();
    }

    public function update(string $event, Post $post = null, User $user = null, Comment $comment = null, string $replyText = null): void {
        if ($event === 'reply' && $post && $user && $comment && $replyText) {
            echo $user->getUserName() . " replied to a comment on the post: " . $post->getContent() . "\n";
        }
    }

}
