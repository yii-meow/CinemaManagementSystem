<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Reply')]
class Reply
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $replyID;

    //Foreign key
    #[ORM\ManyToOne(inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'commentID', referencedColumnName: 'commentID', nullable: false)]
    private Comment $comment;


    #[ORM\Column(type: 'string', length: 255)]
    private $replyText;

    #[ORM\ManyToOne(inversedBy: 'reply')]
    #[ORM\JoinColumn(name: 'replyUserID', referencedColumnName: 'userId', nullable: false)]
    private User $userReply;

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

    public function getUserReply()
    {
        return $this->userReply;
    }

    public function setUserReply($userReply): self
    {
         $this->userReply = $userReply;
         return $this;
    }

}
