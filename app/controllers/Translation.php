<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\controllers;
// Provide (REST API)

use App\core\Controller;
use App\services\GoogleTranslateAPI\TranslationService;

class Translation
{
    use Controller;
    public function index()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postContent = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
            $targetLanguage = 'en';

            if (empty($postContent)) {
                echo json_encode(['error' => 'Content cannot be empty']);
                exit;
            }

            try {
                $translator = new TranslationService();
                $translatedText = $translator->translate($postContent, $targetLanguage);

                echo json_encode(['translatedText' => $translatedText]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Invalid request method']);
        }
    }
}
