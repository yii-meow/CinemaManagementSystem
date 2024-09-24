<?php
//namespace WebServices\LeonardLohHanWei\ExtractKeywordAPI;
use App\Core;

/**
 * Author: Leonard Loh Han Wei
 */

class requestTopicTaggingAPI{
    public function requestAPI($paragraph){
        // Initialize a cURL session
        $ch = curl_init();

        // URL of the API
        $apiUrl = "http://localhost/CinemaManagementSystem/app/services/ExtractKeywordAPI/TopicTaggingService.php";

        // Data to send in the POST request
        $data = array(
            'paragraph' => $paragraph
        );

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);           // Set the URL
        curl_setopt($ch, CURLOPT_POST, 1);                // Indicate this is a POST request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);  // Attach the JSON data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',             // Set the content type to JSON
            'Content-Length: ' . strlen($jsonData)
        ));

        // Execute the cURL request and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        // Output the API response
        return $response;
    }
}



