<?php

/*require_once 'GoogleTranslateService.php';

class TranslateController
{
    public function translate()
    {
        // Get the post content and target language from the request
        $postContent = $_POST['content'] ?? '';
        $targetLanguage = $_POST['language'] ?? 'en'; // Default to English

        // Use the GoogleTranslateService to translate the text
        $translator = new GoogleTranslateService();
        $translatedText = $translator->translateText($postContent, $targetLanguage);

        // Return the translated text as a JSON response
        echo json_encode(['translatedText' => $translatedText]);
    }
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TranslateController();
    $controller->translate();
}*/
