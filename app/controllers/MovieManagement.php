<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;
use App\xml\Movie\MovieXMLGenerator;

class MovieManagement
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        $movies = $this->cinemaFacade->getAllMovies();
        return $this->view("Admin/Movie/MovieManagement", ['movies' => $movies]);
    }

    public function addMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieData = $_POST;

            // Handle file upload
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $uploadDir = SITE_ROOT . '/assets/images/movies/';
                $fileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension;
                $uploadFile = $uploadDir . $fileName;

                // Ensure the upload directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    // Store the URL path in the database
                    $movieData['photo'] = '/assets/images/movies/' . $fileName;
                    error_log("File uploaded successfully to: " . $uploadFile);
                } else {
                    error_log("Failed to upload file. Error: " . print_r(error_get_last(), true));
                    jsonResponse([
                        'success' => false,
                        'message' => 'Failed to upload image.',
                        'error' => error_get_last()
                    ]);
                    return;
                }
            } else {
                jsonResponse([
                    'success' => false,
                    'message' => 'No image uploaded or upload error.',
                    'error' => $_FILES['photo']['error']
                ]);
                return;
            }
            try {
                $this->cinemaFacade->addMovie($movieData);
                jsonResponse(['success' => true, 'message' => 'Movie added successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'Error adding movie: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function editMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $movieData = json_decode(file_get_contents("php://input"), true);
            try {
                $this->cinemaFacade->updateMovie($movieData['movieId'], $movieData);
                jsonResponse(['success' => true, 'message' => 'Movie updated successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'Error updating movie: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function removeMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $movieId = $_GET['movieId'] ?? null;
            if (!$movieId) {
                jsonResponse(['success' => false, 'message' => 'Movie ID is required']);
                return;
            }
            try {
                $this->cinemaFacade->removeMovie($movieId);
                jsonResponse(['success' => true, 'message' => 'Movie removed successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'Error removing movie: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function exportMovieToXML()
    {
        try {
            $xmlGenerator = new MovieXMLGenerator();
            $result = $xmlGenerator->generateMovieXML();

            // Prepare the response
            $response = [
                'xml' => base64_encode($result['xml'])
            ];

            jsonResponse($response);
        } catch (\Exception $e) {
            error_log("Error in exportMovieToXML: " . $e->getMessage());
            jsonResponse(["error" => $e->getMessage()]);
        }
    }
}