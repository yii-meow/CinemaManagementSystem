<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace app\services\GoogleTranslateAPI;

class TranslationService
{
    public function translate($content, $targetLanguage)
    {
        // RapidAPI key
        $apiKey = "f9f98207c1msh172ad62387fd118p17287fjsn4f1ef3e3ab92";

        // API endpoint for translation
        $url = "https://google-translate1.p.rapidapi.com/language/translate/v2";

        $postData = http_build_query([
            'q' => $content,
            'target' => $targetLanguage
        ]);

        // Initialize cURL
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: google-translate1.p.rapidapi.com",
                "x-rapidapi-key: $apiKey",
                "Content-Type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl); // check error
        curl_close($curl); // close session

        if ($err) {
            throw new \Exception("cURL Error: " . $err);
        }

        if ($httpCode == 200) {
            $responseData = json_decode($response, true);
            if (isset($responseData['data']['translations'][0]['translatedText'])) {
                return $responseData['data']['translations'][0]['translatedText'];
            } else {
                throw new \Exception("Translation Fail");
            }
        } else {
            throw new \Exception("API request failed with status code " . $httpCode);
        }
    }
}

