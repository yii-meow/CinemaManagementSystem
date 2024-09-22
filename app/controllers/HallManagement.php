<?php
/**
 * @author Chong Yik Soon
 */
namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class HallManagement
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

            $hallId = isset($_GET['hallId']) ? $_GET['hallId'] : null;
            $cinemaInformation = $this->cinemaFacade->getFormattedCinemaHallDetails($hallId);

            return $this->view("Admin/Hall/HallManagement", ['cinemaInformation' => $cinemaInformation]);
        } else {
            $this->view("Admin/403PermissionDenied");
        }
    }

    public function updateHall()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            jsonResponse(['success' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        $putData = json_decode(file_get_contents("php://input"), true);

        if (empty($putData)) {
            jsonResponse(['success' => false, 'message' => 'No data provided for update']);
            return;
        }

        try {
            $this->cinemaFacade->updateCinemaHall($putData['hallId'], $putData);
            jsonResponse(['success' => true, 'message' => 'Cinema hall updated successfully']);
        } catch (\Exception $e) {
            jsonResponse(['success' => false, 'message' => 'Error updating cinema hall: ' . $e->getMessage()]);
        }
    }

    public function removeHall($hallId = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            jsonResponse(['success' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        if (!$hallId) {
            jsonResponse(['success' => false, 'message' => 'Hall ID is required']);
            return;
        }

        try {
            $result = $this->cinemaFacade->removeCinemaHall($hallId);
            if ($result) {
                jsonResponse(['success' => true, 'message' => 'Cinema hall removed successfully']);
            } else {
                jsonResponse(['success' => false, 'message' => 'Failed to remove cinema hall']);
            }
        } catch (\Exception $e) {
            jsonResponse(['success' => false, 'message' => 'Error removing cinema hall: ' . $e->getMessage()]);
        }
    }
}