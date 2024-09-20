<?php
namespace App\Observers;

use App\models\Comment;
use App\models\Post;
use App\models\User;

interface ObserverInterface {
    public function update(string $event, Post $post = null, User $user = null, Comment $comment = null, string $replyText = null): void;
}
