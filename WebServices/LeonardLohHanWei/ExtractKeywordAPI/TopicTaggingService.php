<?php

namespace WebServices\LeonardLohHanWei\ExtractKeywordAPI;
use App\Core;

/**
 * Author: Leonard Loh Han Wei
 */

// Check if the paragraph is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (!isset($inputData['paragraph']) || empty($inputData['paragraph'])) {
        echo json_encode(['error' => 'Paragraph is missing']);
    } else {
        // Call the extractKeywords function
        echo extractKeywords($inputData['paragraph']);
    }
} else {
    echo json_encode(['error' => 'Only POST requests are allowed']);
}


// Function to extract valuable keywords from a paragraph and return as JSON
function extractKeywords($paragraph) {
    // Extended list of common stopwords to ignore
    $stopwords = array(
        'i', 'me', 'my', 'myself', 'we', 'our', 'ours', 'ourselves', 'you', 'your', 'yours',
        'he', 'him', 'his', 'she', 'her', 'hers', 'it', 'its', 'they', 'them', 'their',
        'the', 'is', 'in', 'on', 'at', 'a', 'an', 'and', 'or', 'for', 'with', 'this', 'that',
        'to', 'of', 'are', 'was', 'were', 'be', 'been', 'has', 'had', 'have', 'do', 'does',
        'did', 'will', 'would', 'shall', 'should', 'can', 'could', 'up', 'down', 'out', 'about',
        'very', 'then', 'there', 'so', 'also', 'just', 'if', 'from', 'by', 'as', 'because'
    );

    // Normalize the text (lowercase, remove special characters)
    $paragraph = strtolower($paragraph);
    $paragraph = preg_replace('/[^a-z0-9\s]/', '', $paragraph);

    // Split the paragraph into words
    $words = explode(' ', $paragraph);

    // Remove stopwords and filter out short words (optional, words with less than 4 characters)
    $filteredWords = array_filter($words, function($word) use ($stopwords) {
        return !in_array($word, $stopwords) && strlen($word) > 4;
    });

    // Count the frequency of each word
    $wordFrequency = array_count_values($filteredWords);

    // Sort the keywords by frequency in descending order
    arsort($wordFrequency);

    // Get the most frequent and valuable keywords (optional: limit the number of keywords returned)
    $keywords = array_slice(array_keys($wordFrequency), 0, 6);

    // Return the result as a JSON object
    return json_encode($keywords);
}







