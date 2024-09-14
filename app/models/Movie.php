<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Movie")]
class Movie
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $movieId;

    #[ORM\Column(type: "string", length: 255)]
    private $title;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $photo;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $trailerLink;

    #[ORM\Column(type: "integer", nullable: true)]
    private $duration;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $catagory;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $releaseDate;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $language;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $subtitles;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $director;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $casts;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $classification;

    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private $status;

    /**
     * @return mixed
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * @param mixed $movieId
     */
    public function setMovieId($movieId): void
    {
        $this->movieId = $movieId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getTrailerLink()
    {
        return $this->trailerLink;
    }

    /**
     * @param mixed $trailerLink
     */
    public function setTrailerLink($trailerLink): void
    {
        $this->trailerLink = $trailerLink;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getCatagory()
    {
        return $this->catagory;
    }

    /**
     * @param mixed $catagory
     */
    public function setCatagory($catagory): void
    {
        $this->catagory = $catagory;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getSubtitles()
    {
        return $this->subtitles;
    }

    /**
     * @param mixed $subtitles
     */
    public function setSubtitles($subtitles): void
    {
        $this->subtitles = $subtitles;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director): void
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getCasts()
    {
        return $this->casts;
    }

    /**
     * @param mixed $casts
     */
    public function setCasts($casts): void
    {
        $this->casts = $casts;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * @param mixed $classification
     */
    public function setClassification($classification): void
    {
        $this->classification = $classification;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }


}

?>