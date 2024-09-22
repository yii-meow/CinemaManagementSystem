<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;
use App\repositories\FeedbackRepository;
use App\State\FeedbackState;


#[ORM\Table(name: 'Feedback')]
#[ORM\Entity(repositoryClass:FeedbackRepository::class)]
class Feedback
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $feedbackID;

    //Foreign key - Many to One alway the owning side (use InversedBy)
    #[ORM\ManyToOne(inversedBy: 'feedback')] // feedback is the owning side
    #[ORM\JoinColumn(name: 'userID', referencedColumnName: 'userId', nullable: false)]
    private User $user;

    #[ORM\Column(type: 'string', length: 255)]
    private $content;

    #[ORM\Column(type: 'integer')]
    private $rating;

    #[ORM\Column(type: 'string', length: 255)]
    private $reply;

    #[ORM\Column(type: 'integer')]
    private $coinCompensation;

    #[ORM\Column(type: 'string', length: 50)]
    private $status;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $inProgress_at;

    #[ORM\Column(type: 'datetime')]
    private $resolved_at;

    #[ORM\Column(type: 'datetime')]
    private $compensationOffered_at;

    public function __construct(FeedbackState $state) {
        $this->setStatus($state);
    }

    public function getFeedbackID(): ?int
    {
        return $this->feedbackID;
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

    public function setContent($content): self
    {
        $this->content = $content;
        return $this;
    }


    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating($rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function getReply(): ?string
    {
        return $this->reply;
    }

    public function setReply($reply): self
    {
        $this->reply = $reply;
        return $this;
    }

    public function getCoinCompensation(): ?int
    {
        return $this->coinCompensation;
    }

    public function setCoinCompensation($coinCompensation): self
    {
        $this->coinCompensation = $coinCompensation;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getInProgressAt(): ?\DateTimeInterface
    {
        return $this->inProgress_at;
    }

    /**
     * @param mixed $inProgress_at
     */
    public function setInProgressAt(\DateTimeInterface $inProgress_at): self
    {
        $this->inProgress_at = $inProgress_at;
        return $this;
    }

    public function getResolvedAt(): ?\DateTimeInterface
    {
        return $this->resolved_at;
    }

    /**
     * @param mixed $resolved_at
     */
    public function setResolvedAt(\DateTimeInterface $resolved_at): self
    {
        $this->resolved_at = $resolved_at;
        return $this;
    }

    public function getCompensationOfferedAt(): ?\DateTimeInterface
    {
        return $this->compensationOffered_at;
    }

    /**
     * @param mixed $compensationOffered_at
     */
    public function setCompensationOfferedAt(\DateTimeInterface $compensationOffered_at): self
    {
        $this->compensationOffered_at = $compensationOffered_at;
        return $this;
    }


    // Getters and setters
    public function proceed(Feedback $feedback) {
        return $this->status->proceed($feedback);
    }

    public function problemSolved(Feedback $feedback) {
        echo "Cannot offer compensation. Feedback is still being worked on.\n";
        return $this->status->problemSolved($feedback);
    }

    public function offerCompensation(Feedback $feedback) {
        return $this->status->offerCompensation($feedback);
    }


}
