<?php

namespace App\services\YoutubeAPI;

class TrailerLinkGenerator
{
    public function fetchTrailer($movieTitle)
    {
        $encodedTitle = urlencode($movieTitle);
        $url = "http://localhost:5000/movies/{$encodedTitle}/trailer";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json']);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            error_log("cURL Error in fetchTrailer: $error");
            return null;
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $data = json_decode($response, true);

        if ($httpCode == 200 && isset($data['data']['attributes']['link'])) {
            // Extract video ID from the YouTube link
            $videoId = $this->extractYouTubeId($data['data']['attributes']['link']);

            if ($videoId) {
                // Construct embedded link
                return "https://www.youtube.com/embed/{$videoId}";
            }
        }

        $errorMessage = $data['errors'][0]['detail'] ?? "HTTP Error: $httpCode";
        error_log("Error in fetchTrailer: $errorMessage");
        return null;
    }

    private function extractYouTubeId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }
        return null;
    }
}


?>