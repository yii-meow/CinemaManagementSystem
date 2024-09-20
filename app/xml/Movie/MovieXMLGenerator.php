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
        $categories = $xml->xpath('//movie/category');
        $categoryCounts = [];
        foreach ($categories as $category) {
            $categoryName = (string)$category;
            $categoryCounts[$categoryName] = isset($categoryCounts[$categoryName]) ? $categoryCounts[$categoryName] + 1 : 1;
        }
        $results['category_counts'] = $categoryCounts;

        // Find movies longer than 120 minutes
        $longMovies = $xml->xpath('//movie[duration > 120]/title');
        $longMoviesList = [];
        foreach ($longMovies as $movie) {
            $longMoviesList[] = (string)$movie;
        }
        $results['long_movies'] = $longMoviesList;

        // Count movies by language
//        $languages = $xml->xpath('//movie/language');
//        $languageCounts = [];
//        foreach ($languages as $language) {
//            $languageName = $language->nodeValue;
//            $languageCounts[$languageName] = isset($languageCounts[$languageName]) ? $languageCounts[$languageName] + 1 : 1;
//        }
//        $results['language_counts'] = $languageCounts;

        // Find movies released in the last year
        $oneYearAgo = date('Y-m-d', strtotime('-1 year'));
        $recentMovies = $xml->xpath("//movie[releaseDate >= '$oneYearAgo']/title");
        $recentMoviesList = [];
        foreach ($recentMovies as $movie) {
            $recentMoviesList[] = $movie->nodeValue;
        }
        $results['recent_movies'] = $recentMoviesList;

//         Find the average duration of movies
        $totalDuration = $xml->xpath->evaluate('sum(//movie/duration)');
        $movieCount = $xml->xpath->evaluate('count(//movie)');
        $results['average_duration'] = $movieCount > 0 ? $totalDuration / $movieCount : 0;

        return $results;
    }
}