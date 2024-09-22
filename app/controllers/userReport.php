<?php
/**
 * Author: Chong Kah Yan
 */
namespace App\controllers;
require_once __DIR__ . '/../../vendor/fpdf/fpdf.php';

use App\core\Controller;
use App\core\Database;
use App\models\User;
use FPDF; // Make sure this is properly autoloaded by Composer

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
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'SuperAdmin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $status = $_POST['status'] ?? 'Both'; // Get the selected status or default to 'Both'

                // Generate XML file from database
                $this->generateXML($status);

                // Define paths to XML and XSL files
                $xmlPath = 'C:/xampp/htdocs/CinemaManagementSystem/app/xml/userData';
                $xslPath = 'C:/xampp/htdocs/CinemaManagementSystem/app/xml/UserReport';

                // Check if files exist
                if (!file_exists($xmlPath)) {
                    die("Error: XML file not found at $xmlPath");
                }
                if (!file_exists($xslPath)) {
                    die("Error: XSL file not found at $xslPath");
                }

                // Load XML
                $xml = new \DOMDocument;
                $xml->load($xmlPath);

                // Load XSL
                $xsl = new \DOMDocument;
                $xsl->load($xslPath);

                // Create XSLTProcessor
                $proc = new \XSLTProcessor;
                $proc->importStylesheet($xsl);

                // Set the parameter for XSLT
                $proc->setParameter('', 'selectedStatus', $status);

                // Transform XML
                $html = $proc->transformToXML($xml);

                // Output the result
                echo $html;
            } else {
                // Show the form if the request method is not POST
                $this->view('Admin/User/userReport'); // Load the form view
            }
        } else {
            // Redirect to permission denied page if user is not a SuperAdmin
            $this->view("Admin/403PermissionDenied");
        }
    }

    public function export()
    {
        $type = $_GET['type'] ?? 'csv'; // Default to 'csv' if not provided

        if (!in_array($type, ['csv', 'pdf'])) {
            die('Invalid export type');
        }

        // Fetch user data
        $users = $this->userRepository->findAll();

        if ($type === 'csv') {
            // Export to CSV
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="user_report.csv"');

            $output = fopen('php://output', 'w');
            fputcsv($output, ['UserID', 'UserName', 'PhoneNo', 'Email', 'Gender', 'Status']); // CSV headers

            foreach ($users as $user) {
                fputcsv($output, [
                    $user->getUserID(),
                    $user->getUserName(),
                    $user->getPhoneNo(),
                    $user->getEmail(),
                    $user->getGender(),
                    $user->getStatus()
                ]);
            }

            fclose($output);
            exit();
        } elseif ($type === 'pdf') {
            // Export to PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);

            // Set title
            $pdf->Cell(0, 10, 'User Management Report', 0, 1, 'C');

            // Add table header with adjusted column widths
            $pdf->Cell(30, 10, 'UserID', 1, 0, 'C');
            $pdf->Cell(30, 10, 'UserName', 1, 0, 'C');
            $pdf->Cell(30, 10, 'PhoneNo', 1, 0, 'C');
            $pdf->Cell(60, 10, 'Email', 1, 0, 'C');
            $pdf->Cell(15, 10, 'Gender', 1, 0, 'C');
            $pdf->Cell(25, 10, 'Status', 1, 1, 'C'); // Move to next line

            // Add table data
            foreach ($users as $user) {
                $pdf->Cell(30, 10, $user->getUserID(), 1);
                $pdf->Cell(30, 10, $user->getUserName(), 1);
                $pdf->Cell(30, 10, $user->getPhoneNo(), 1);
                $pdf->Cell(60, 10, $user->getEmail(), 1);
                $pdf->Cell(15, 10, $user->getGender(), 1);
                $pdf->Cell(25, 10, $user->getStatus(), 1);
                $pdf->Ln();
            }

            // Output the PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment;filename="user_report.pdf"');

            $pdf->Output('php://output', 'I');
            exit();
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
        $xml->save('C:/xampp/htdocs/CinemaManagementSystem/app/xml/userData');
    }
}