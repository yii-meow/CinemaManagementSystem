<?php

namespace App\xml\Movie;

use App\core\Controller;
use App\Facade\CinemaFacade;
use DOMDocument;
use DOMXPath;

class MovieXMLGenerator
{
    use Controller;

    private $cinemaFacade;
    private $xmlDirectory;
    private $xmlFilePath;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
        $this->xmlDirectory = dirname(__DIR__) . '/Movie/';
        $this->xmlFilePath = $this->xmlDirectory . 'movies_summary.xml';
    }

    public function generateMovieXML()
    {
        try {
            $movies = $this->cinemaFacade->getAllMovies();

            if (empty($movies)) {
                throw new \Exception("No movies found");
            }

            // Generate main XML
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="movie_summary.xsl"?><root><movies></movies></root>');

            foreach ($movies as $movie) {
                $movieElement = $xml->movies->addChild('movie');
                $movieElement->addChild('title', htmlspecialchars($movie->getTitle()));
                $movieElement->addChild('director', htmlspecialchars($movie->getDirector()));
                $movieElement->addChild('duration', $movie->getDuration());
                $movieElement->addChild('category', htmlspecialchars($movie->getCatagory()));
                $movieElement->addChild('classification', htmlspecialchars($movie->getClassification()));
                $movieElement->addChild('releaseDate', $movie->getReleaseDate()->format('Y-m-d'));
                $movieElement->addChild('language', htmlspecialchars($movie->getLanguage()));
                $movieElement->addChild('status', htmlspecialchars($movie->getStatus()));
                $movieElement->addChild('description', htmlspecialchars($movie->getDescription()));
                $movieElement->addChild('casts', htmlspecialchars($movie->getCasts()));
                $movieElement->addChild('trailerLink', htmlspecialchars($movie->getTrailerLink()));

                // Add movie schedules
                $schedulesElement = $movieElement->addChild('schedules');
                foreach ($movie->getMovieSchedules() as $schedule) {
                    $scheduleElement = $schedulesElement->addChild('schedule');
                    $scheduleElement->addChild('startingTime', $schedule->getStartingTime()->format('Y-m-d H:i:s'));
                    $scheduleElement->addChild('cinemaHall', htmlspecialchars($schedule->getCinemaHall()->getHallName()));
                }
            }

            // Save raw movies XML
            $xmlPath = $this->xmlDirectory . '/movies_raw.xml';
            if (file_put_contents($xmlPath, $xml->asXML()) === false) {
                throw new \Exception("Failed to save XML file: " . $xmlPath);
            }

            // Perform XPath queries
            $xpathResults = $this->performXPathQueriesSimpleXML($xml);

            // Add XPath results to XML
            $resultsElement = $xml->addChild('xpath_results');
            $resultsElement->addChild('total_movies', $xpathResults['total_movies']);

            $categoryCounts = $resultsElement->addChild('category_counts');
            foreach ($xpathResults['category_counts'] as $category => $count) {
                $categoryElement = $categoryCounts->addChild('category');
                $categoryElement->addChild('name', htmlspecialchars($category));
                $categoryElement->addChild('count', $count);
            }

            $longMovies = $resultsElement->addChild('long_movies');
            foreach ($xpathResults['long_movies'] as $movie) {
                $longMovies->addChild('movie', htmlspecialchars($movie));
            }

            $languageCounts = $resultsElement->addChild('language_counts');
            foreach ($xpathResults['language_counts'] as $language => $count) {
                $languageElement = $languageCounts->addChild('language');
                $languageElement->addChild('name', htmlspecialchars($language));
                $languageElement->addChild('count', $count);
            }

            $resultsElement->addChild('average_duration', number_format($xpathResults['average_duration'], 2));

            $upcomingMovies = $resultsElement->addChild('upcoming_movies');
            foreach ($xpathResults['upcoming_movies'] as $movie) {
                $upcomingMovies->addChild('movie', htmlspecialchars($movie));
            }

            $popularMovies = $resultsElement->addChild('popular_movies');
            foreach ($xpathResults['popular_movies'] as $movie) {
                $popularMovies->addChild('movie', htmlspecialchars($movie));
            }

            $xmlString = $xml->asXML();

            // Transform XML to HTML using XSLT
            $xsltProcessor = new \XSLTProcessor();
            $xsltDoc = new \DOMDocument();
            $xsltDoc->load($this->xmlDirectory . 'movie_summary.xsl');
            $xsltProcessor->importStylesheet($xsltDoc);

            $xmlDoc = new \DOMDocument();
            $xmlDoc->loadXML($xmlString);
            $htmlOutput = $xsltProcessor->transformToXML($xmlDoc);

            if ($htmlOutput === false) {
                throw new \Exception("XSLT transformation failed");
            }
            return [
                'xml' => $xmlString,
                'html' => $htmlOutput
            ];

        } catch (\Exception $e) {
            error_log("Error in generateMovieXML: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }

    private function performXPathQueriesSimpleXML($xml)
    {
        $results = [];

        // Count total number of movies
        $results['total_movies'] = count($xml->xpath('//movie'));

        // Count movies by category
        $categoryCounts = [];
        foreach ($xml->xpath('//movie/category') as $category) {
            $categories = explode(',', (string)$category);
            foreach ($categories as $cat) {
                $cat = trim($cat);
                $categoryCounts[$cat] = isset($categoryCounts[$cat]) ? $categoryCounts[$cat] + 1 : 1;
            }
        }
        arsort($categoryCounts); // Sort categories by count in descending order
        $results['category_counts'] = $categoryCounts;

        // Find movies longer than 120 minutes
        $longMovies = $xml->xpath('//movie[duration > 120]/title');
        $longMoviesList = [];
        foreach ($longMovies as $movie) {
            $longMoviesList[] = (string)$movie;
        }
        $results['long_movies'] = $longMoviesList;

        // Count movies by language
        $languages = $xml->xpath('//movie/language');
        $languageCounts = [];
        foreach ($languages as $language) {
            $languageName = (string)$language;
            $languageCounts[$languageName] = isset($languageCounts[$languageName]) ? $languageCounts[$languageName] + 1 : 1;
        }
        $results['language_counts'] = $languageCounts;

        // Calculate average duration of movies
        $durations = $xml->xpath('//movie/duration');
        $totalDuration = 0;
        foreach ($durations as $duration) {
            $totalDuration += (int)$duration;
        }
        $results['average_duration'] = $results['total_movies'] > 0 ? $totalDuration / $results['total_movies'] : 0;

        // Find upcoming movies (release date in the future)
        $currentDate = date('Y-m-d');
        $upcomingMovies = $xml->xpath("//movie[releaseDate > '$currentDate']/title");
        $upcomingMoviesList = [];
        foreach ($upcomingMovies as $movie) {
            $upcomingMoviesList[] = (string)$movie;
        }
        $results['upcoming_movies'] = $upcomingMoviesList;

        // Find popular movies (movies with the most schedules)
        $movies = $xml->xpath('//movie');
        $movieScheduleCounts = [];
        foreach ($movies as $movie) {
            $title = (string)$movie->title;
            $scheduleCount = count($movie->xpath('schedules/schedule'));
            $movieScheduleCounts[$title] = $scheduleCount;
        }
        arsort($movieScheduleCounts);
        $results['popular_movies'] = array_slice(array_keys($movieScheduleCounts), 0, 5);

        return $results;
    }
}