<?php
/**
 * @author Chong Yik Soon
 */

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
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'SuperAdmin') {
            $movies = $this->cinemaFacade->getAllMovies();
            return $this->view("Admin/Movie/MovieManagement", ['movies' => $movies]);
        } else {
            $this->view("Admin/403PermissionDenied");
        }
    }

//    Routing to add movie page
    public function addPage()
    {
        if (isset($_SESSION['admin'])
            && $_SESSION['admin']['role'] === 'SuperAdmin') {
            return $this->view("Admin/Movie/AddMovie");
        } else {
            $this->view("Admin/403PermissionDenied");
        }
    }

    public function addMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieData = $_POST;
            $errors = $this->validateAddMovieData($movieData);

            if (empty($errors)) {
                // Handle file upload
                $photoUploadResult = $this->handlePhotoUpload();
                if ($photoUploadResult['success']) {
                    $movieData['photo'] = $photoUploadResult['path'];
                } else {
                    $errors['photo'] = $photoUploadResult['message'];
                }

                if (empty($errors)) {
                    try {
                        $this->cinemaFacade->addMovie($movieData);
                        jsonResponse(['success' => true, 'message' => 'Movie added successfully']);
                    } catch (\Exception $e) {
                        jsonResponse(['success' => false, 'message' => 'Error adding movie: ' . $e->getMessage()]);
                    }
                }
            }

            if (!empty($errors)) {
                jsonResponse(['success' => false, 'message' => 'Validation errors', 'errors' => $errors]);
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $movieId = $data['movieId'] ?? null;

            if (!$movieId) {
                jsonResponse(['success' => false, 'message' => 'Movie ID is required']);
                return;
            }

            try {
                $result = $this->cinemaFacade->removeMovie($movieId);
                if ($result) {
                    jsonResponse(['success' => true, 'message' => 'Movie removed successfully']);
                } else {
                    jsonResponse(['success' => false, 'message' => 'Movie not found or could not be removed']);
                }
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
                'xml' => base64_encode($result['xml']),
                'html' => base64_encode($result['html']),
            ];
            jsonResponse($response);
            exit;
        } catch (\Exception $e) {
            jsonResponse(["error" => $e->getMessage()]);
        }
    }

    private function validateAddMovieData($data)
    {
        $errors = [];

        // Title validation
        if (empty($data['title']) || strlen($data['title']) > 255) {
            $errors['title'] = 'Title is required and must be 255 characters or less.';
        }

        // Duration validation
        if (!isset($data['duration']) || !is_numeric($data['duration']) || $data['duration'] < 1 || $data['duration'] > 1000) {
            $errors['duration'] = 'Duration must be a number between 1 and 1000 minutes.';
        }

        // Category validation
        if (empty($data['catagory']) || strlen($data['catagory']) > 100) {
            $errors['catagory'] = 'Category is required and must be 100 characters or less.';
        }

        // Classification validation
        $validClassifications = ['G', 'PG', 'PG-13', 'R', 'NC-17'];
        if (!in_array($data['classification'], $validClassifications)) {
            $errors['classification'] = 'Invalid classification.';
        }

        // Status validation
        $validStatuses = ['Now Showing', 'Coming Soon', 'Not Showing'];
        if (!in_array($data['status'], $validStatuses)) {
            $errors['status'] = 'Invalid status.';
        }

        // Release date validation
        if (empty($data['releaseDate']) || !strtotime($data['releaseDate'])) {
            $errors['releaseDate'] = 'Invalid release date.';
        }

        // Language validation
        if (empty($data['language']) || strlen($data['language']) > 50) {
            $errors['language'] = 'Language is required and must be 50 characters or less.';
        }

        // Subtitles validation (optional field)
        if (!empty($data['subtitles']) && strlen($data['subtitles']) > 100) {
            $errors['subtitles'] = 'Subtitles must be 100 characters or less.';
        }

        // Director validation
        if (empty($data['director']) || strlen($data['director']) > 100) {
            $errors['director'] = 'Director is required and must be 100 characters or less.';
        }

        // Casts validation
        if (empty($data['casts']) || strlen($data['casts']) > 500) {
            $errors['casts'] = 'Casts information is required and must be 500 characters or less.';
        }

        // Description validation
        if (empty($data['description']) || strlen($data['description']) < 10 || strlen($data['description']) > 1000) {
            $errors['description'] = 'Description is required and must be between 10 and 1000 characters.';
        }

        return $errors;
    }
}