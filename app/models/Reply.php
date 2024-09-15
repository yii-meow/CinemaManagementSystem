<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;
use SplSubject;

#[ORM\Entity]
#[ORM\Table(name: 'Reply')]
class Reply implements SplSubject
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $replyID;

    #[ORM\ManyToOne(targetEntity: 'Comment', inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'commentID', referencedColumnName: 'commentID', nullable: false)]
    private $comment;

    #[ORM\Column(type: 'string', length: 255)]
    private $replyText;

    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(name: 'replyUserID', referencedColumnName: 'userId', nullable: false)]
    private $replyUser;

    private $observers = [];

    public function getReplyID(): ?int
    {
        return $this->replyID;
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    public function setComment(Comment $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getReplyText(): ?string
    {
        return $this->replyText;
    }

    public function setReplyText(string $replyText): self
    {
        $this->replyText = $replyText;
        return $this;
    }

    public function getReplyUser(): ?User
    {
        return $this->replyUser;
    }

    public function setReplyUser(User $replyUser): self
    {
        $this->replyUser = $replyUser;
        return $this;
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers = array_filter($this->observers, function($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
