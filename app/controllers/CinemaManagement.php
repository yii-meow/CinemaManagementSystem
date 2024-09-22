<?php
/**
 * @author Chong Yik Soon
 */
namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class CinemaManagement
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        if (isset($_SESSION['admin']) &&
            $_SESSION['admin']['role'] === 'SuperAdmin') {
            $cinemas = $this->cinemaFacade->getFormattedCinemas();
            $this->view('Admin/Cinema/CinemaManagement', ['cinemas' => $cinemas]);
        } else {
            $this->view("Admin/403PermissionDenied");
        }
    }

    public function addCinema()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $address = $_POST['address'] ?? '';
            $city = $_POST['city'] ?? '';
            $state = $_POST['state'] ?? '';
            $openingHours = $_POST['openingHours'] ?? '';

            if (empty($name) || empty($address) || empty($city) || empty($state) || empty($openingHours)) {
                jsonResponse(['success' => false, 'message' => 'Please fill in all required fields.']);
                return;
            }

            try {
                $this->cinemaFacade->addCinema($name, $address, $city, $state, $openingHours);
                jsonResponse(['success' => true, 'message' => 'Cinema added successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function removeCinema($cinemaId = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            jsonResponse(['success' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        if (!$cinemaId) {
            jsonResponse(['success' => false, 'message' => 'Cinema ID is required']);
            return;
        }

        try {
            $result = $this->cinemaFacade->removeCinema($cinemaId);
            if ($result) {
                jsonResponse(['success' => true, 'message' => 'Cinema removed successfully']);
            } else {
                jsonResponse(['success' => false, 'message' => 'Failed to remove cinema']);
            }
        } catch (\Exception $e) {
            jsonResponse(['success' => false, 'message' => 'Error removing cinema: ' . $e->getMessage()]);
        }
    }
}