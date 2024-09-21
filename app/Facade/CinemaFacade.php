<?php

namespace App\Facade;

use App\core\Database;
use App\models\Cinema;
use App\models\CinemaHall;
use App\models\MovieSchedule;
use App\models\Movie;
use App\models\TicketPricing;
use DateTime;
use App\services\YoutubeAPI\TrailerLinkGenerator;
use App\Logger\CinemaLogger;
use Monolog\Logger;

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
        $this->logger = new CinemaLogger();
    }

    public function getAllCinemas()
    {
        return $this->cinemaRepository->findAll();
    }

    // Cinema Management
    public function getFormattedCinemas()
    {
        $cinemaEntities = $this->cinemaRepository->getCinemaHallNumber();

        return array_map(function ($cinema) {
            return [
                'cinemaId' => $cinema["cinemaId"],
                'name' => $cinema["name"],
                'city' => $cinema['city'],
                'state' => $cinema["state"],
                'openingHours' => formatOpeningHours($cinema["openingHours"]),
                'hallCount' => $cinema["hallCount"]
            ];
        }, $cinemaEntities);
    }

    public function getFormattedCinemaHallDetails($hallId)
    {
        $cinemaHall = $this->cinemaHallRepository->findByHallId($hallId);

        if (!$cinemaHall || !$cinemaHall->getCinema()) {
            return null;
        }

        return [
            'cinemaName' => $cinemaHall->getCinema()->getName(),
            'hallName' => $cinemaHall->getHallName(),
            'hallId' => $cinemaHall->getHallId(),
            'capacity' => $cinemaHall->getCapacity(),
            'hallType' => $cinemaHall->getHallType()
        ];
    }

    public function getCinemaWithHalls($cinemaId)
    {
        $cinema = $this->cinemaRepository->find($cinemaId);

        if (!$cinema) {
            throw new \Exception("Cinema not found");
        }

        $cinemaHalls = $cinema->getCinemaHalls();

        return [
            'cinema' => $cinema,
            'cinemaHalls' => $cinemaHalls
        ];
    }

    // Cinema Hall Management
    public function getNextHallName($cinemaId)
    {
        return $this->cinemaHallRepository->getNextHallName($cinemaId);
    }

    // Movie Schedule Management
    public function getHallScheduleData($hallId)
    {
        $cinemaHall = $this->cinemaHallRepository->findByHallId($hallId);

        $cinemaInformation = null;
        if ($cinemaHall && $cinemaHall->getCinema()) {
            $cinemaInformation = [
                'name' => $cinemaHall->getCinema()->getName(),
                'hallName' => $cinemaHall->getHallName(),
                'hallId' => $cinemaHall->getHallId()
            ];
        }

        $showtimes = $this->movieScheduleRepository->findUpcomingSchedulesByHall($hallId);
        $groupedSchedules = [];
        foreach ($showtimes as $showtime) {
            $date = $showtime->getStartingTime()->format('Y-m-d');
            $movieId = $showtime->getMovie()->getMovieId();
            $groupedSchedules[$date][$movieId]['movie'] = $showtime->getMovie();
            $groupedSchedules[$date][$movieId]['times'][] = [
                'id' => $showtime->getMovieScheduleId(),
                'time' => $showtime->getStartingTime(),
                'fullDateTime' => $showtime->getStartingTime()->format('Y-m-d\TH:i:s')
            ];
        }

        $movies = $this->movieRepository->findAll();
        $movieArray = array_map(function ($movie) {
            return [
                'id' => $movie->getMovieId(),
                'title' => $movie->getTitle()
            ];
        }, $movies);

        return [
            'groupedSchedules' => $groupedSchedules,
            'movies' => $movieArray,
            'cinemaInformation' => $cinemaInformation
        ];
    }

    public function getCinemaHallWithDetails($hallId)
    {
        $cinemaHall = $this->cinemaHallRepository->findByHallId($hallId);

        if (!$cinemaHall || !$cinemaHall->getCinema()) {
            return null;
        }

        return [
            'cinema' => $cinemaHall->getCinema(),
            'hall' => $cinemaHall
        ];
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

        $this->logger->info('Cinema added', [
            'cinemaId' => $cinema->getCinemaId(),
            'name' => $name,
            'city' => $city,
            'state' => $state
        ]);

        return $cinema;
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

        $this->logger->info('Cinema updated', [
            'cinemaId' => $cinemaId,
            'updatedFields' => array_keys($data)
        ]);

        return $cinema;
    }

    public function removeCinema($cinemaId)
    {
        $cinema = $this->cinemaRepository->find($cinemaId);
        if (!$cinema) {
            throw new \Exception("Cinema not found");
        }

        try {
            // Instead of removing, we're just marking it as inactive
            $this->entityManager->remove($cinema);
            $this->entityManager->flush();

            $this->logger->info('Cinema removed', [
                'cinema id' => $cinemaId,
                'cinema name' => $cinema->getName()
            ]);

            return true;
        } catch (\Exception $e) {
            $this->logger->error('Cinema failed to be removed', [
                'cinema id' => $cinemaId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
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

        $this->logger->info('CinemaHall added', [
            'cinemaId' => $cinemaId,
            'hall name' => $hallName,
            'capacity' => $capacity,
            'hall type' => $hallType
        ]);

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

        $this->logger->info('CinemaHall updated', [
            'hall id' => $hallId
        ]);

        return $hall;
    }

    public function removeCinemaHall($hallId)
    {
        $hall = $this->cinemaHallRepository->findByHallId($hallId);
        if (!$hall) {
            throw new \Exception("Hall not found");
        }

        try {
            $this->entityManager->remove($hall);
            $this->entityManager->flush();

            $this->logger->info('CinemaHall removed', [
                'hall id' => $hallId,
                'hall name' => $hall->getHallName(),
                'cinema id' => $hall->getCinema()->getCinemaId()
            ]);

            return true;
        } catch (\Exception $e) {
            $this->logger->error('Failed to remove CinemaHall', [
                'hall id' => $hallId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function getMovieSchedules()
    {
        return $this->movieScheduleRepository->findMovieSchedule();
    }

    public function addMovieSchedule($cinemaHallId, $movieId, $startingTime)
    {
        $movie = $this->movieRepository->find($movieId);
        $cinemaHall = $this->cinemaHallRepository->find($cinemaHallId);

        if (!$movie || !$cinemaHall) {
            throw new \Exception("Invalid movie or cinema hall");
        }

        $movieSchedule = new MovieSchedule();
        $movieSchedule->setStartingTime(new DateTime($startingTime));
        $movieSchedule->setMovie($movie);
        $movieSchedule->setCinemaHall($cinemaHall);

        $this->entityManager->persist($movieSchedule);
        $this->entityManager->flush();

        $this->logger->info('MovieSchedule added', [
            'movie id' => $movieId,
            'cinema hall id' => $cinemaHallId,
            'starting time' => $startingTime,
        ]);

        return $movieSchedule;
    }

    public function updateMovieSchedule($scheduleId, DateTime $startingTime)
    {
        $movieSchedule = $this->movieScheduleRepository->find($scheduleId);

        if (!$movieSchedule) {
            throw new \Exception("Movie schedule not found");
        }

        $movieSchedule->setStartingTime($startingTime);

        $this->entityManager->flush();

        $this->logger->info('MovieSchedule updated', [
            'schedule id' => $scheduleId,
            'new starting time' => $startingTime->format('Y-m-d H:i:s'),
        ]);

        return $movieSchedule;
    }

    public function removeMovieSchedule($scheduleId)
    {
        $movieSchedule = $this->movieScheduleRepository->find($scheduleId);

        if (!$movieSchedule) {
            throw new \Exception("Movie schedule not found");
        }

        try {
            $this->entityManager->remove($movieSchedule);
            $this->entityManager->flush();

            $this->logger->info('MovieSchedule removed', [
                'schedule id' => $scheduleId,
                'movie id' => $movieSchedule->getMovie()->getMovieId(),
                'cinema hall id' => $movieSchedule->getCinemaHall()->getHallId(),
            ]);

            return true;
        } catch (\Exception $e) {
            $this->logger->error('Failed to remove MovieSchedule', [
                'schedule id' => $scheduleId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function getAllMovies()
    {
        return $this->movieRepository->findAll();
    }

    public function getComingSoonMovies()
    {
        return $this->movieRepository->findComingSoonMovies();
    }

    public function searchMovies($search = '', $category = '')
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('m', 'ms', 'ch', 'c')
            ->from(Movie::class, 'm')
            ->leftJoin('m.movieSchedules', 'ms')
            ->leftJoin('ms.cinemaHall', 'ch')
            ->leftJoin('ch.cinema', 'c')
            ->where('m.status = :status')
            ->setParameter('status', 'Now Showing');

        // If user using search query
        if ($search) {
            $qb->andWhere($qb->expr()->like('m.title', ':search'))
                ->setParameter('search', '%' . $search . '%');
        }

        // If user click the category
        if ($category && $category !== 'All') {
            $qb->andWhere($qb->expr()->like('m.catagory', ':category'))
                ->setParameter('category', '%' . $category . '%');
        }

        $movies = $qb->getQuery()->getResult();

        $moviesWithGroupedSchedules = [];
        foreach ($movies as $movie) {
            $movieData = [
                'movieId' => $movie->getMovieId(),
                'title' => $movie->getTitle(),
                'photo' => $movie->getPhoto(),
                'duration' => $movie->getDuration(),
                'classification' => $movie->getClassification(),
                'language' => $movie->getLanguage(),
                'category' => $movie->getCatagory(),
                'cinemas' => []
            ];

            $cinemas = [];
            foreach ($movie->getMovieSchedules() as $schedule) {
                $cinemaHall = $schedule->getCinemaHall();
                $cinema = $cinemaHall->getCinema();
                $cinemaId = $cinema->getCinemaId();

                if (!isset($cinemas[$cinemaId])) {
                    $cinemas[$cinemaId] = [
                        'id' => $cinemaId,
                        'name' => $cinema->getName(),
                        'showtimes' => []
                    ];
                }

                $cinemas[$cinemaId]['showtimes'][] = [
                    'scheduleId' => $schedule->getMovieScheduleId(),
                    'time' => $schedule->getStartingTime(),
                    'hallType' => $cinemaHall->getHallType()
                ];
            }

            $movieData['cinemas'] = array_values($cinemas);
            $moviesWithGroupedSchedules[] = $movieData;
        }

        return $moviesWithGroupedSchedules;
    }

    public function addMovie($movieData)
    {
        $movie = new Movie();
        $this->setMovieData($movie, $movieData);

        $this->entityManager->persist($movie);
        $this->entityManager->flush();

        $this->logger->info('Movie added', [
            'movie title' => $movieData['title'],
            'duration' => $movieData['duration'],
            'category' => $movieData['catagory'],
            'release date' => $movieData['releaseDate'],
            'status' => $movieData['status'],
        ]);

        return $movie;
    }

    private function setMovieData(Movie $movie, array $data)
    {
        if (isset($data['title'])) {
            $movie->setTitle($data['title']);
            $trailerLink = $this->fetchTrailer($data['title']);
            if ($trailerLink !== null) {
                $movie->setTrailerLink($trailerLink);
            }
        }
        if (isset($data['photo'])) $movie->setPhoto($data['photo']);
        if (isset($data['duration'])) $movie->setDuration($data['duration']);
        if (isset($data['catagory'])) $movie->setCatagory($data['catagory']);
        if (isset($data['releaseDate'])) $movie->setReleaseDate(new DateTime($data['releaseDate']));
        if (isset($data['language'])) $movie->setLanguage($data['language']);
        if (isset($data['subtitles'])) $movie->setSubtitles($data['subtitles']);
        if (isset($data['director'])) $movie->setDirector($data['director']);
        if (isset($data['casts'])) $movie->setCasts($data['casts']);
        if (isset($data['description'])) $movie->setDescription($data['description']);
        if (isset($data['classification'])) $movie->setClassification($data['classification']);
        if (isset($data['status'])) $movie->setStatus($data['status']);
    }

    private function fetchTrailer($movieTitle)
    {
        $movieTrailer = new TrailerLinkGenerator();
        return $movieTrailer->fetchTrailer($movieTitle);
    }

    public function updateMovie($movieId, $movieData)
    {
        $movie = $this->movieRepository->find($movieId);

        if (!$movie) {
            throw new \Exception("Movie not found");
        }

        // Update the movie properties
        if (isset($movieData['title'])) $movie->setTitle($movieData['title']);
        if (isset($movieData['catagory'])) $movie->setCatagory($movieData['catagory']);
        if (isset($movieData['director'])) $movie->setDirector($movieData['director']);
        if (isset($movieData['duration'])) $movie->setDuration((int)$movieData['duration']);
        if (isset($movieData['classification'])) $movie->setClassification($movieData['classification']);
        if (isset($movieData['releaseDate'])) $movie->setReleaseDate(new \DateTime($movieData['releaseDate']));
        if (isset($movieData['language'])) $movie->setLanguage($movieData['language']);
        if (isset($movieData['subtitles'])) $movie->setSubtitles($movieData['subtitles']);
        if (isset($movieData['casts'])) $movie->setCasts($movieData['casts']);
        if (isset($movieData['description'])) $movie->setDescription($movieData['description']);

        try {
            $this->entityManager->flush();
            $this->logger->info('Movie updated', [
                'movie title' => $movieData['title'],
            ]);
            return true;
        } catch (\Exception $e) {
            // Log the error
            $this->logger->error('Movie updated', [
                'movie title' => $movieData['title'],
                'message' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function removeMovie($movieId)
    {
        $movie = $this->movieRepository->find($movieId);

        if (!$movie) {
            return false;
        }

        try {
            $this->entityManager->remove($movie);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            // Log the error
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function getTicketPricing()
    {
        $ticketPricing = $this->entityManager->getRepository(TicketPricing::class)->find(1);
        return $ticketPricing;
    }

    public function updateTicketPricing($data)
    {
        $ticketPricing = $this->getTicketPricing();

        // Update only the properties that are present in the $data array
        if (isset($data['baseTicketIMAX'])) {
            $ticketPricing->setBaseTicketIMAX($data['baseTicketIMAX']);
        }
        if (isset($data['baseTicketDeluxe'])) {
            $ticketPricing->setBaseTicketDeluxe($data['baseTicketDeluxe']);
        }
        if (isset($data['baseTicketAtmos'])) {
            $ticketPricing->setBaseTicketAtmos($data['baseTicketAtmos']);
        }
        if (isset($data['baseTicketBenie'])) {
            $ticketPricing->setBaseTicketBenie($data['baseTicketBenie']);
        }

        if (isset($data['timeBasedWeekdayBefore12'])) {
            $ticketPricing->setTimeBasedWeekdayBefore12($data['timeBasedWeekdayBefore12']);
        }
        if (isset($data['timeBasedWeekdayAfter12'])) {
            $ticketPricing->setTimeBasedWeekdayAfter12($data['timeBasedWeekdayAfter12']);
        }
        if (isset($data['timeBasedWeekend'])) {
            $ticketPricing->setTimeBasedWeekend($data['timeBasedWeekend']);
        }
        if (isset($data['timeBasedMidnight'])) {
            $ticketPricing->setTimeBasedMidnight($data['timeBasedMidnight']);
        }

        if (isset($data['commissionFee'])) {
            $ticketPricing->setCommissionFee($data['commissionFee']);
        }

        try {
            $this->entityManager->flush();

            $this->logger->info('TicketPricing updated', [
                'ticket price' => $data,
            ]);

            return true;
        } catch (\Exception $e) {
            // Log the error
            error_log($e->getMessage());
            return false;
        }
    }

    public function getLogs($date = null)
    {
        $logger = new CinemaLogger();
        return $logger->getLogs($date);
    }
}