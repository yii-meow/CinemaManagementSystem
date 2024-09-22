<?php
/**
 * @author Chong Yik Soon
 */
namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class TicketPricingManagement
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
            $ticketPricing = $this->cinemaFacade->getTicketPricing();

            // Pass the data to the view
            $this->view('Admin/Ticket/TicketPricingManagement', [
                'ticketPricing' => $ticketPricing
            ]);
        } else {
            $this->view("Admin/403PermissionDenied");
        }
    }

    public function updatePricing()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $result = $this->cinemaFacade->updateTicketPricing($data);

            if ($result) {
                // Redirect back to the pricing management page with a success message
                jsonResponse(["success" => true]);
                exit;
            } else {
                // Redirect back with an error message
                jsonResponse(["success" => false]);
                exit;
            }
        }
    }
}