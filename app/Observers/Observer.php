<?php
//Observer
namespace App\Observers;

use App\Observers\Subject;
use App\models\Post;

abstract class Observer {

    protected $subject; //  hold a reference

    public function __construct(Subject $subject) {
        $this->subject = $subject;
    }

    public abstract function update(string $action,$post, $user): void;

}

?>
