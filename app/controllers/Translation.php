<?php
namespace App\controllers;
// Provide (REST API)

use App\core\Controller;
use App\services\TranslationService;

class Translation
{
    use Controller;
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postContent = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);

            // only translated to English
            $targetLanguage = 'en';

            try {
                // Access the translate API
                $translator = new TranslationService();
                $translatedText = $translator->translate($postContent, $targetLanguage);

                // Return translated text as a JSON response
               echo json_encode(['translatedText' => $translatedText]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Invalid content']);
        }
    }
}
