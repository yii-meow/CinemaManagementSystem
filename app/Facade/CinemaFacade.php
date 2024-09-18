<?php

namespace App\Facade;

use App\core\Database;
use App\models\Cinema;
use App\models\CinemaHall;
use App\models\MovieSchedule;
use App\models\Movie;

class CinemaFacade
{
    private $entityManager;
    private $cinemaRepository;
    private $cinemaHallRepository;
    private $movieScheduleRepository;
    private $movieRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
    }

    // Cinema Management
    public function getAllCinemas()
    {
        return $this->cinemaRepository->getCinemaHallNumber();
    }

    public function addCinema($name, $address, $city, $state, $openingHours)
    {
        $cinema = new Cinema();
        $cinema->setName($name);
        $cinema->setAddress($address);
        $cinema->setCity($city);
        $cinema->setState($state);
        $cinema->setOpeningHours($openingHours);

        $this->entityManager->persist($cinema);
        $this->entityManager->flush();

        return $cinema;
    }

    public function getCinemaDetails($cinemaId)
    {
        return $this->cinemaRepository->find($cinemaId);
    }

    public function updateCinema($cinemaId, $data)
    {
        $cinema = $this->cinemaRepository->find($cinemaId);
        if (!$cinema) {
            throw new \Exception("Cinema not found");
        }

        if (isset($data['name'])) $cinema->setName($data['name']);
        if (isset($data['address'])) $cinema->setAddress($data['address']);
        if (isset($data['city'])) $cinema->setCity($data['city']);
        if (isset($data['state'])) $cinema->setState($data['state']);
        if (isset($data['openingHours'])) $cinema->setOpeningHours($data['openingHours']);

        $this->entityManager->flush();
        return $cinema;
    }

    // Cinema Hall Management
    public function getNextHallName($cinemaId)
    {
        return $this->cinemaHallRepository->getNextHallName($cinemaId);
    }

    public function addCinemaHall($cinemaId, $hallName, $capacity, $hallType)
    {
        $cinema = $this->cinemaRepository->find($cinemaId);
        if (!$cinema) {
            throw new \Exception("Cinema not found");
        }

        $cinemaHall = new CinemaHall();
        $cinemaHall->setHallName($hallName);
        $cinemaHall->setCapacity((int)$capacity);
        $cinemaHall->setHallType($hallType);
        $cinemaHall->setCinema($cinema);

        $this->entityManager->persist($cinemaHall);
        $this->entityManager->flush();

        return $cinemaHall;
    }

    public function updateCinemaHall($hallId, $data)
    {
        $hall = $this->cinemaHallRepository->findByHallId($hallId);
        if (!$hall) {
            throw new \Exception("Hall not found");
        }

        if (isset($data['hallType'])) {
            $validTypes = ['IMAX', 'DELUXE', 'ATMOS', 'BENIE'];
            if (!in_array($data['hallType'], $validTypes)) {
                throw new \Exception("Invalid hall type");
            }
            $hall->setHallType($data['hallType']);
        }

        if (isset($data['capacity'])) {
            $capacity = intval($data['capacity']);
            if ($capacity <= 0) {
                throw new \Exception("Capacity must be a positive number");
            }
            $hall->setCapacity($capacity);
        }

        $this->entityManager->flush();
        return $hall;
    }

    public function getCinemaHallDetails($hallId)
    {
        return $this->cinemaHallRepository->findByHallId($hallId);
    }

    // Movie Schedule Management
    public function getUpcomingSchedulesByHall($hallId)
    {
        return $this->movieScheduleRepository->findUpcomingSchedulesByHall($hallId);
    }

    public function addMovieSchedule($cinemaHallId, $movieId, $startingTime)
    {
        $movie = $this->movieRepository->find($movieId);
        $cinemaHall = $this->cinemaHallRepository->find($cinemaHallId);

        if (!$movie || !$cinemaHall) {
            throw new \Exception("Invalid movie or cinema hall");
        }

        $movieSchedule = new MovieSchedule();
        $movieSchedule->setStartingTime(new \DateTime($startingTime));
        $movieSchedule->setMovie($movie);
        $movieSchedule->setCinemaHall($cinemaHall);

        $this->entityManager->persist($movieSchedule);
        $this->entityManager->flush();

        return $movieSchedule;
    }

    // Movie Management
    public function getAllMovies()
    {
        return $this->movieRepository->findAll();
    }
}