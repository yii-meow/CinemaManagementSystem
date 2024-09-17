<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;
use SplSubject;

#[ORM\Entity]
#[ORM\Table(name: 'Likes')]
class Likes implements SplSubject
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $likeID;

    //Foreign key
    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[ORM\JoinColumn(name: 'postID', referencedColumnName: 'postID', nullable: false)]
    private Post $post;

    #[ORM\Column(type: 'datetime')]
    private $likeDate;

    #[ORM\ManyToOne(inversedBy: '$liker')]
    #[ORM\JoinColumn(name: 'likedBy', referencedColumnName: 'userId', nullable: false)]
    private User $likedBy;

    private $observers = [];

    public function getLikeID(): ?int
    {
        return $this->likeID;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    public function getLikeDate(): ?\DateTime
    {
        return $this->likeDate;
    }

    public function setLikeDate(\DateTime $likeDate): self
    {
        $this->likeDate = $likeDate;
        return $this;
    }

    public function getLikedBy(): ?User
    {
        return $this->likedBy;
    }

    public function setLikedBy(User $likedBy): self
    {
        $this->likedBy = $likedBy;
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
