<?php
namespace App\models;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use SplSubject;
//Concrete Subject in Observer Design Pattern

#[ORM\Entity]
#[ORM\Table(name: 'Comment')]
class Comment implements SplSubject
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $commentID;

    //Foreign key
    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'postID', referencedColumnName: 'postID', nullable: false)]
    private Post $post;

    #[ORM\ManyToOne(inversedBy: 'commenters')]
    #[ORM\JoinColumn(name: 'commenterID', referencedColumnName: 'userId', nullable: false)]
    private User $commenter;

    #[ORM\OneToMany(mappedBy: 'comment', targetEntity: Reply::class)]
    private Collection $replies;

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

    public function getReplies(): Collection
    {
        return $this->replies;
    }

    // Observer Design pattern

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
