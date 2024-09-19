<?php
//function fetchTrailer($movieTitle)
//{
//    jsonResponse("hi");
//    // URL encode the movie title to handle spaces and special characters
//    $encodedTitle = urlencode($movieTitle);
//
//    // Construct the URL for the API endpoint
//    $url = "http://localhost:5000/movies/{$encodedTitle}/trailer";
//
//    // Initialize a new cURL session
//    $curl = curl_init($url);
//
//    // Set cURL options
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($curl, CURLOPT_HTTPHEADER, [
//        'Accept: application/json'
//    ]);
//
//    // Execute the request
//    $response = curl_exec($curl);
//
//    // Check for errors
//    if ($response === false) {
//        $error = curl_error($curl);
//        curl_close($curl);
//        return ['error' => "cURL Error: $error"];
//    }
//
//    // Get the HTTP status code
//    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//
//    // Close the cURL session
//    curl_close($curl);
//
//    // Decode the JSON response
//    $data = json_decode($response, true);
//
//    // Check if the request was successful
//    if ($httpCode == 200) {
//        return [
//            'success' => true,
//            'trailer_link' => $data['data']['attributes']['link']
//        ];
//    } else {
//        return [
//            'success' => false,
//            'error' => $data['errors'][0]['detail'] ?? "HTTP Error: $httpCode"
//        ];
//    }
//}
//
//// Usage example
////if (isset($_GET['movie_title'])) {
////    $result = fetchTrailer($_GET['movie_title']);
////    echo json_encode($result);
////} else {
////    echo json_encode(['error' => 'No movie title provided']);
////}
//?>