<?php
namespace App\Observers;

use App\core\Database;
use App\models\Comment;
use App\models\Post;
use App\models\User;
use App\Observers\ObserverInterface;

// respond to chnages by sending a notification when a post is liked

class CommentObserver implements ObserverInterface {
    private $entityManager;

    public function __construct() {
        $this->entityManager = Database::getEntityManager();
    }

    public function update(string $event, Post $post = null, User $user = null,Comment $comment = null, string $replyText = null): void {
        if ($event === 'comment' && $post && $user) {
            echo $user->getUserName() . " commented on the post: " . "\n";
        }
    }
}