<?php
namespace App\models;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Reply')]

class ReportRequest{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $reportID;

    #[ORM\Column(type: 'integer')]
    private $postID;

    #[ORM\Column(type: 'datetime')]
    private $reportDate;


    #[ORM\Column(type: 'string', length: 255)]
    private $reportStatus;

    #[ORM\Column(type:'integer')]
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

    public function getPostID(): int
    {
        return $this->postID;
    }

    public function setPostID(int $postID): self
    {
        $this->postID = $postID;
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

    public function getReason(): int
    {
        return $this->reason;
    }

    public function setReason(int $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

}
?>