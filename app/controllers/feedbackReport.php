<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Feedback;
use App\constant\feedback_status;
use DOMXPath;


class feedbackReport{
    use Controller;

    private $entityManager;
    private $userRepository;

    const XML_PATH = 'C:\xampp\htdocs\CinemaManagementSystem\app\xml\Feedback\feedback_data.xml';
    const XSL_PATH = 'C:\xampp\htdocs\CinemaManagementSystem\app\xml\Feedback\feedback_report.xsl';

    public function __construct()
    {
        // Initialize EntityManager and repositories
        $this->entityManager = Database::getEntityManager();
        $this->feedbackRepository = $this->entityManager->getRepository(Feedback::class);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? 'All'; // Get the selected status or default to 'Both'

            //empty it first
            file_put_contents(self::XML_PATH, '<?xml version="1.0" encoding="UTF-8"?><feedbacks></feedbacks>');
            // Generate XML file from database
            $this->generateFeedbackXML($status);

            // Load XML
            $xml = new \DOMDocument;
            $xml->load(self::XML_PATH); // Load your XML data file

            // Load XSL
            $xsl = new \DOMDocument;
            $xsl->load(self::XSL_PATH); // Load your XSL stylesheet

            // Create XSLTProcessor
            $proc = new \XSLTProcessor;
            $proc->importStylesheet($xsl); // Import the XSL stylesheet

            // Set the parameter for XSLT
            //$proc->setParameter('', 'selectedStatus', $status);

            // Transform XML
            echo $proc->transformToXML($xml);

        } else {
            // Show the form if the request method is not POST
            $this->view('Admin/Feedback/Feedback_report'); // Load the form view
        }
    }

    public function generateFeedbackXML($status){
        if ($status == 'All') {
            $feedbacks = $this->feedbackRepository->findAll();
            echo "all";
        } else {
            $feedbacks = $this->feedbackRepository->findBy(['status' => $status]);
        }

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $feedbacksElement = $dom->createElement('feedbacks');

        foreach ($feedbacks as $feedback) {
            $feedbackElement = $dom->createElement('feedback');

            $id         = $dom->createElement('id', $feedback->getFeedbackID());
            $username   = $dom->createElement('username', $feedback->getUser()->getUserName());
            $rating     = $dom->createElement('rating', $feedback->getRating());
            $content    = $dom->createElement('content', $feedback->getContent());
            $status     = $dom->createElement('status', $feedback->getStatus());
            $created_at = $dom->createElement('created_at', $feedback->getCreatedAt()->format('Y-m-d H:i:s'));

            $feedbackElement->appendChild($id);
            $feedbackElement->appendChild($username);
            $feedbackElement->appendChild($rating);
            $feedbackElement->appendChild($content);
            $feedbackElement->appendChild($status);
            $feedbackElement->appendChild($created_at);

            $feedbacksElement->appendChild($feedbackElement);

            $dom->appendChild($feedbacksElement);
            $dom->formatOutput = true;
            $xmlString = $dom->saveXML();

            file_put_contents( self::XML_PATH, $xmlString);

            //echo "XML created: " . self::XML_PATH;
        }


    }

}
