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

            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="movie_summary.xsl"?><movies></movies>');

            foreach ($movies as $movie) {
                $movieElement = $xml->addChild('movie');
                $movieElement->addChild('title', htmlspecialchars($movie->getTitle()));
                $movieElement->addChild('director', htmlspecialchars($movie->getDirector()));
                $movieElement->addChild('duration', $movie->getDuration());
                $movieElement->addChild('category', htmlspecialchars($movie->getCatagory()));
                $movieElement->addChild('classification', htmlspecialchars($movie->getClassification()));
                $movieElement->addChild('releaseDate', $movie->getReleaseDate()->format('Y-m-d'));
                $movieElement->addChild('description', htmlspecialchars($movie->getDescription()));
                $movieElement->addChild('language', htmlspecialchars($movie->getLanguage()));
                $movieElement->addChild('status', htmlspecialchars($movie->getStatus()));
            }

            $xmlString = $xml->asXML();

            if (!is_dir($this->xmlDirectory)) {
                if (!mkdir($this->xmlDirectory, 0755, true)) {
                    throw new \Exception("Failed to create directory: " . $this->xmlDirectory);
                }
            }

            // Check if directory is writable
            if (!is_writable($this->xmlDirectory)) {
                throw new \Exception("Directory is not writable: " . $this->xmlDirectory);
            }

            $rawXmlPath = $this->xmlDirectory . '/movies_raw.xml';

            // Save XML to file
            if (file_put_contents($rawXmlPath, $xmlString) === false) {
                throw new \Exception("Failed to save XML file: " . $filePath);
            }

            $xsl = new \DOMDocument();
            $xsl->load($this->xmlDirectory . '/movie_summary.xsl');

            // Configure the transformer
            $proc = new \XSLTProcessor;
            $proc->importStyleSheet($xsl);

            // Transform XML to HTML
            $xmlDoc = new \DOMDocument();
            $xmlDoc->loadXML($xmlString);
            $htmlOutput = $proc->transformToXML($xmlDoc);

            // Save transformed HTML
            $htmlPath = $this->xmlDirectory . '/movies_summary.html';
            file_put_contents($htmlPath, $htmlOutput);

            // XPath example: Count movies by category
            $xpath = new \DOMXPath($xmlDoc);
            $categories = $xpath->query('//movie/category');
            $categoryCounts = [];
            foreach ($categories as $category) {
                $categoryName = $category->nodeValue;
                $categoryCounts[$categoryName] = isset($categoryCounts[$categoryName]) ? $categoryCounts[$categoryName] + 1 : 1;
            }

            // XPath example: Find movies longer than 120 minutes
            $longMovies = $xpath->query('//movie[duration > 120]/title');
            $longMoviesList = [];
            foreach ($longMovies as $movie) {
                $longMoviesList[] = $movie->nodeValue;
            }

            // Prepare response
            $response = [
                'message' => 'XML generated and transformed successfully',
                'raw_xml_path' => $rawXmlPath,
                'html_summary_path' => $htmlPath,
                'category_counts' => $categoryCounts,
                'long_movies' => $longMoviesList
            ];

            // Output response
            jsonResponse($response);

        } catch (\Exception $e) {
            error_log("Error in generateMovieXML: " . $e->getMessage());
            jsonResponse(["error" => $e->getMessage()]);
        }
    }
}