<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;
use SplSubject;

#[ORM\Entity]
#[ORM\Table(name: 'Comment')]
class Comment implements SplSubject
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $commentID;

    #[ORM\ManyToOne(targetEntity: 'Post', inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'postID', referencedColumnName: 'postID', nullable: false)]
    private $post;

    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(name: 'commenterID', referencedColumnName: 'userId', nullable: false)]
    private $commenter;

    #[ORM\Column(type: 'string', length: 255)]
    private $commentText;

    private $observers = [];

    public function getCommentID(): ?int
    {
        return $this->commentID;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    public function getCommenter(): ?User
    {
        return $this->commenter;
    }

    public function setCommenter(User $commenter): self
    {
        $this->commenter = $commenter;
        return $this;
    }

    public function getCommentText(): ?string
    {
        return $this->commentText;
    }

    public function setCommentText(string $commentText): self
    {
        $this->commentText = $commentText;
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
