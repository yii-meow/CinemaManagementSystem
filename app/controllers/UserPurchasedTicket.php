<?php
/**
 * @Chew Zi An
 */


namespace App\controllers;
require_once __DIR__ . '/../../vendor/fpdf/fpdf.php';

use App\core\Controller;
use App\core\Database;
use App\models\Ticket;
use App\repositories\TicketRepository;
use Doctrine\ORM\EntityRepository;
use DOMDocument;
use FPDF;
use SimpleXMLElement;
use XSLTProcessor;

class UserPurchasedTicket
{
    use Controller;

    private $entityManager;
    private ticketRepository $ticketRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->ticketRepository = $this->entityManager->getRepository(Ticket::class);
    }

    public function index()
    {
        if (isset($_SESSION['admin'])) {

            //Create XML Root
            $xml = new SimpleXMLElement('<?xml version="1.0"?><tickets></tickets>');

            //Find all user ticket
            $ticketsData = [];
            $tickets = $this->ticketRepository->findAllTickets();
            if ($tickets) {
                foreach ($tickets as $ticket) {
                    //Return Result
                    $ticketsData[] = $ticket;

                    //Generate XML
                    $ticketNode = $xml->addChild('ticket');
                    $ticketNode->addChild('ticketId', $ticket["ticketId"]);
                    $ticketNode->addChild('customerName', $ticket["customerName"]);
                    $ticketNode->addChild('ticketStatus', $ticket["ticketStatus"]);
                    $ticketNode->addChild('paymentStatus', $ticket["paymentStatus"]);
                    $ticketNode->addChild('movieTitle', $ticket["movieTitle"]);
                    $ticketNode->addChild('startingTime', $ticket["startingTime"]->format('Y-m-d H:i:s'));
                    $ticketNode->addChild('seatNo', $ticket["seatNo"]);
                    $ticketNode->addChild('totalPrice', $ticket["totalPrice"]);
                }

                //Store the XML as file
                $filePath = 'C:\xampp\htdocs\CinemaManagementSystem\app\xml\ticket.xml';
                $xml->asXML($filePath);

            }

            //Return result to view
            $data = [
                "tickets" => $ticketsData,
            ];

            //Render view
            $this->view("Admin/Ticket/UserPurchasedTicket", $data);
        } else {
            // Redirect to permission denied page if user is not a SuperAdmin
            $this->view("Admin/403PermissionDenied");
        }
    }


    //Export to PDF
    public function exportPDF()
    {
        // Use relative path for XML file
        $xmlFilePath = __DIR__ . "/../xml/ticket.xml";
        $pdfFilePath = __DIR__ . "/../Export/PDF/ticket.pdf";

        // Load the XML file
        $xml = @simplexml_load_file($xmlFilePath);
        if ($xml === false) {
            echo "Error: Cannot load XML file. Please check if the file exists and is readable.";
            return;
        }

        // Create new PDF document
        $pdf = new FPDF('L');
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Ticket Information', 0, 1, 'C');

        // Add header row
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 10, 'ID', 1);
        $pdf->Cell(50, 10, 'Name', 1);
        $pdf->Cell(25, 10, 'Status', 1);
        $pdf->Cell(20, 10, 'Payment', 1);
        $pdf->Cell(125, 10, 'Movie', 1);
        $pdf->Cell(45, 10, 'Time', 1);
        $pdf->Ln();

        // Add data rows
        $pdf->SetFont('Arial', '', 12);
        foreach ($xml->ticket as $ticket) {
            $pdf->Cell(10, 20, (string)$ticket->ticketId, 1);
            $pdf->Cell(50, 20, (string)$ticket->customerName, 1);
            $pdf->Cell(25, 20, (string)$ticket->ticketStatus, 1);
            $pdf->Cell(20, 20, (string)$ticket->paymentStatus, 1);
            $pdf->Cell(125, 20, (string)$ticket->movieTitle, 1);
            $pdf->Cell(45, 20, (string)$ticket->startingTime, 1);
            $pdf->Ln();
        }

        // Save the PDF to the file system
        $pdf->Output('F', $pdfFilePath); // 'F' means save to a file

        // Now read the PDF file and output it to the browser for download
        if (file_exists($pdfFilePath)) {
            // Set headers for PDF download
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="ticket.pdf"');
            header('Content-Length: ' . filesize($pdfFilePath));
            header('Pragma: no-cache');
            header('Expires: 0');

            // Output the file to the browser
            readfile($pdfFilePath);
        } else {
            echo "Error: PDF file could not be found for download.";
        }

        exit();
    }


    //Export to CSV
    public function exportCSV()
    {
        // Use relative paths
        $xmlFilePath = __DIR__ . "/../xml/ticket.xml";
        $csvFilePath = __DIR__ . "/../Export/CSV/ticket.csv";

        // Ensure the export directory exists
        $exportDir = dirname($csvFilePath);
        if (!is_dir($exportDir) && !mkdir($exportDir, 0755, true)) {
            echo "Error: Unable to create export directory.";
            return;
        }

        // Load the XML file
        $xmlCSV = @simplexml_load_file($xmlFilePath);
        if ($xmlCSV === false) {
            echo "Error: Cannot load XML file. Please check if the file exists and is readable.";
            return;
        }

        // Open a file for writing CSV data
        $csvFile = @fopen($csvFilePath, 'w');
        if ($csvFile === false) {
            echo "Error: Cannot open CSV file for writing. Please check directory permissions.";
            return;
        }

        // Define the CSV file header
        fputcsv($csvFile, array('Ticket ID', 'Customer Name', 'Ticket Status', 'Payment Status', 'Movie Title', 'Starting Time', 'Seats No', 'Total Price'));

        // Iterate through each ticket in the XML file
        foreach ($xmlCSV->ticket as $ticket) {
            $row = array(
                (string)$ticket->ticketId,
                (string)$ticket->customerName,
                (string)$ticket->ticketStatus,
                (string)$ticket->paymentStatus,
                (string)$ticket->movieTitle,
                (string)$ticket->startingTime,
                (string)$ticket->seatNo,
                (string)$ticket->totalPrice
            );
            fputcsv($csvFile, $row);
        }

        // Close the CSV file
        fclose($csvFile);

        // Now read the CSV file and output it to the browser for download
        if (file_exists($csvFilePath)) {
            // Set headers for CSV download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="ticket.csv"');
            header('Content-Length: ' . filesize($csvFilePath));
            header('Pragma: no-cache');
            header('Expires: 0');

            // Output the file to the browser
            readfile($csvFilePath);
        } else {
            echo "Error: CSV file could not be found for download.";
        }

        exit();
    }

    public function showXSLT(){
        //Call XML File
        $xmlFilePath = __DIR__ . "/../xml/ticket.xml";
        $xml = @simplexml_load_file($xmlFilePath);

        //Load the XSLT File
        $xslFilePath = __DIR__ . "/../xml/ticket.xsl";
        $xslt = new XSLTProcessor();
        $xsl = new DOMDocument;
        $xsl->load($xslFilePath);
        $xslt->importStylesheet($xsl);
        $xslt->setParameter('','ROOT', ROOT);

        // Transform the XML
        $result = $xslt->transformToXML($xml);

        if ($result) {
            header('Content-Type: text/html');
            echo $result;
        } else {
            echo 'Transformation failed.';
        }
    }

}