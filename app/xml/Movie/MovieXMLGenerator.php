<?php

namespace App\xml\Movie;

use App\core\Controller;
use App\Facade\CinemaFacade;

class MovieXMLGenerator
{
    use Controller;

    private $cinemaFacade;
    private $xmlDirectory;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
        $this->xmlDirectory = dirname(__DIR__) . '/Movie/';
    }

    public function generateMovieXML()
    {
        try {
            $movies = $this->cinemaFacade->getAllMovies();

            if (empty($movies)) {
                throw new \Exception("No movies found");
            }

            // Generate main XML
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="movie_summary.xsl"?><root></root>');

            $moviesElement = $xml->addChild('movies');
            foreach ($movies as $movie) {
                $movieElement = $moviesElement->addChild('movie');
                $movieElement->addChild('title', htmlspecialchars($movie->getTitle()));
                $movieElement->addChild('director', htmlspecialchars($movie->getDirector()));
                $movieElement->addChild('duration', $movie->getDuration());
                $movieElement->addChild('category', htmlspecialchars($movie->getCatagory()));
                $movieElement->addChild('classification', htmlspecialchars($movie->getClassification()));
                $movieElement->addChild('releaseDate', $movie->getReleaseDate()->format('Y-m-d'));
                $movieElement->addChild('language', htmlspecialchars($movie->getLanguage()));
                $movieElement->addChild('status', htmlspecialchars($movie->getStatus()));
            }

            // XPath results
            $xpathResults = $xml->addChild('xpath_results');

            // XPath: Count total number of movies
            $totalMovies = count($movies);
            $xpathResults->addChild('total_movies', $totalMovies);

            // XPath: Count movies by category
            $categoryCounts = [];
            foreach ($movies as $movie) {
                $category = $movie->getCatagory();
                $categoryCounts[$category] = isset($categoryCounts[$category]) ? $categoryCounts[$category] + 1 : 1;
            }

            $categoriesElement = $xpathResults->addChild('category_counts');
            foreach ($categoryCounts as $category => $count) {
                $categoryElement = $categoriesElement->addChild('category');
                $categoryElement->addChild('name', htmlspecialchars($category));
                $categoryElement->addChild('count', $count);
            }

            // XPath: Find movies longer than 120 minutes
            $longMoviesElement = $xpathResults->addChild('long_movies');
            foreach ($movies as $movie) {
                if ($movie->getDuration() > 120) {
                    $longMoviesElement->addChild('movie', htmlspecialchars($movie->getTitle()));
                }
            }

            $xmlString = $xml->asXML();

            // Save XML to file
            $xmlPath = $this->xmlDirectory . '/movies_summary.xml';
            if (file_put_contents($xmlPath, $xmlString) === false) {
                throw new \Exception("Failed to save XML file: " . $xmlPath);
            }

            // Transform XML to HTML
            $xsl = new \DOMDocument();
            $xsl->load($this->xmlDirectory . '/movie_summary.xsl');
            $proc = new \XSLTProcessor;
            $proc->importStyleSheet($xsl);
            $xmlDom = new \DOMDocument();
            $xmlDom->loadXML($xmlString);
            $htmlOutput = $proc->transformToXML($xmlDom);

            // Save transformed HTML
            $htmlPath = $this->xmlDirectory . '/movies_summary.html';
            file_put_contents($htmlPath, $htmlOutput);

            return [
                'xml' => $xmlString,
                'html' => $htmlOutput
            ];

        } catch (\Exception $e) {
            error_log("Error in generateMovieXML: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
}