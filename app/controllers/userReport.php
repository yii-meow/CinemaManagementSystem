<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\User;

class userReport
{
    use Controller;

    private $entityManager;
    private $userRepository;

    public function __construct()
    {
        // Initialize EntityManager and repositories
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? 'Both'; // Get the selected status or default to 'Both'

            // Generate XML file from database
            $this->generateXML($status);

            // Define the correct paths to your XML and XSL files
            $xmlPath = 'C:\xampp\htdocs\CinemaManagementSystem\app\xml\userData';
            $xslPath = 'C:\xampp\htdocs\CinemaManagementSystem\app\xml\UserReport';

            // Check if files exist
            if (!file_exists($xmlPath)) {
                die("Error: XML file not found at $xmlPath");
            }
            if (!file_exists($xslPath)) {
                die("Error: XSL file not found at $xslPath");
            }

            // Load XML
            $xml = new \DOMDocument;
            $xml->load($xmlPath); // Load your XML data file

            // Load XSL
            $xsl = new \DOMDocument;
            $xsl->load($xslPath); // Load your XSL stylesheet

            // Create XSLTProcessor
            $proc = new \XSLTProcessor;
            $proc->importStylesheet($xsl); // Import the XSL stylesheet

            // Set the parameter for XSLT
            $proc->setParameter('', 'selectedStatus', $status);

            // Transform XML
            $html = $proc->transformToXML($xml);

            // Output the result
            echo $html; // Display the transformed XML (e.g., as HTML)
        } else {
            // Show the form if the request method is not POST
            $this->view('Admin/User/userReport'); // Load the form view
        }
    }

    private function generateXML($status)
    {
        // Adjust query to retrieve user data based on status
        $criteria = [];
        if ($status === 'Both') {
            // Fetch all users if status is 'Both'
            $users = $this->userRepository->findAll();
        } else {
            // Fetch users based on selected status
            $criteria['status'] = $status;
            $users = $this->userRepository->findBy($criteria);
        }

        // Create a new XML document
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        // Create the root element
        $root = $xml->createElement('UsersReport');
        $xml->appendChild($root);

        // Fetch and add each user to the XML
        foreach ($users as $user) {
            $userElement = $xml->createElement('User');

            $elements = [
                'UserID' => $user->getUserID(),
                'UserName' => $user->getUserName(),
                'PhoneNo' => $user->getPhoneNo(),
                'Email' => $user->getEmail(),
                'Gender' => $user->getGender(),
                'Status' => $user->getStatus()
            ];

            foreach ($elements as $key => $value) {
                $element = $xml->createElement($key, htmlspecialchars($value));
                $userElement->appendChild($element);
            }

            $root->appendChild($userElement);
        }

        // Save XML to file
        $xml->save('C:\xampp\htdocs\CinemaManagementSystem\app\xml\userData');
    }
}