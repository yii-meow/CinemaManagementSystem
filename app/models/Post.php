<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;
use App\repositories\PostRepository;


#[ORM\Table(name: 'Post')]
#[ORM\Entity(repositoryClass:PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $postID;

    //Foreign key - Many to One alway the owning side (use InversedBy)
    #[ORM\ManyToOne(inversedBy: 'posts')] // post is the owning side
    #[ORM\JoinColumn(name: 'userID', referencedColumnName: 'userId', nullable: false)]
    private User $user;

    //Foreign side
    #[ORM\OneToMany(mappedBy: 'post', targetEntity: 'Comment')]
    private $comments;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: 'Likes')]
    private $likes;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: 'ReportRequest')]
    private $reportPost;


    #[ORM\Column(type: 'string', length: 255)]
    private $content;

    #[ORM\Column(type: 'datetime')]
    private $postDate;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private $contentImg;

    #[ORM\Column(type: 'string', length: 50)]
    private $status;

    // Getters and setters
    public function getPostID(): ?int
    {
        return $this->postID;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->postDate;
    }

    public function setPostDate(\DateTimeInterface $postDate): self
    {
        $this->postDate = $postDate;
        return $this;
    }

    public function getContentImg(): ?string
    {
        return $this->contentImg;
    }

    public function setContentImg(?string $contentImg): self
    {
        $this->contentImg = $contentImg;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

}
