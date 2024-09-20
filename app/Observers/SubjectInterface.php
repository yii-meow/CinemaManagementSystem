<?php
namespace App\Observers;

use App\models\Post;
use App\models\User;

interface SubjectInterface
{
    public function attach(ObserverInterface $observer): void;

    public function detach(ObserverInterface $observer): void;

    public function notifyAllObservers(string $event, Post $post = null, User $user = null): void;
}
