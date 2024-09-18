<?php
namespace App\models;
use App\repositories\ReportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:ReportRepository::class)]
#[ORM\Table(name: 'ReportRequest')]

class ReportRequest{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $reportID;

    //Foreign key
    #[ORM\ManyToOne(inversedBy: 'reportPost')]
    #[ORM\JoinColumn(name: 'postID', referencedColumnName: 'postID', nullable: false)]
    private Post $post;

    #[ORM\Column(type: 'datetime')]
    private $reportDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $reportStatus;

    #[ORM\Column(type:'string',length:50)]
    private $reason;

    public function getReportID(): ?int
    {
        return $this->reportID;
    }

    public function setReportID(int $reportID): self
    {
        $this->reportID = $reportID;
        return $this;
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

    public function getReportDate(): ?\DateTimeInterface
    {
        return $this->reportDate;
    }

    public function setReportDate(\DateTimeInterface $reportDate): self
    {
        $this->reportDate = $reportDate;
        return $this;
    }

    public function getReportStatus(): string
    {
        return $this->reportStatus;
    }

    public function setReportStatus(string $reportStatus): self
    {
        $this->reportStatus = $reportStatus;
        return $this;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

}
?>