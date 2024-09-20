<?php

namespace App\xml;

use App\core\Controller;
use App\Facade\CinemaFacade;

class MovieXMLGenerator
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function generateMovieXML()
    {
        try {
            $xmlDirectory = dirname(__DIR__) . '/xml';

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

            if (!is_dir($xmlDirectory)) {
                if (!mkdir($xmlDirectory, 0755, true)) {
                    throw new \Exception("Failed to create directory: " . $this->xmlDirectory);
                }
            }

            // Check if directory is writable
            if (!is_writable($xmlDirectory)) {
                throw new \Exception("Directory is not writable: " . $this->xmlDirectory);
            }

            $filePath = $xmlDirectory . '/movies.xml';

            // Save XML to file
            if (file_put_contents($filePath, $xmlString) === false) {
                throw new \Exception("Failed to save XML file: " . $filePath);
            }

            // Output XML
            header('Content-Type: application/xml');
            header('Content-Disposition: attachment; filename="movies.xml"');
            echo $xmlString;
        } catch (\Exception $e) {
            error_log("Error in generateMovieXML: " . $e->getMessage());
            jsonResponse(["error" => $e->getMessage()]);
        }
    }
}