<?php
namespace App\controllers;
use App\core\Controller;

class AddPost
{
    use Controller;
    // File management - to limit the file size and validate file format
    const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2 MB
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png'];
    const ALLOWED_MIME_TYPES = ['image/jpeg', 'image/png'];

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = 3; // Hardcoded userId
            $status = "Approved";
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
            $image = $_FILES['contentImg'] ?? null;

            show("Content:" .$content);
            // Check if content is not empty
            if (!empty($content)) {
                $imagePath = null;

                // If an image was uploaded, validate it
                if ($image && $image['error'] === UPLOAD_ERR_OK) {
                    $imagePath = $this->validateUploadImage($image);
                    if ($imagePath === false) {
                        exit; //Invalid file
                    }
                }

                // Prepare data for database insertion
                $arr = [
                    'userID' => $userId,
                    'content' => $content,
                    'contentImg' => $imagePath ?? null,
                    'status' => $status
                ];

                // Insert post into the database
                $model = new Post();
                $result = $model->createPost($arr);

                // Redirect based on success or failure
                if ($result) {
                    header('Location: ' . ROOT . '/AddPost?message=success');
                } else {
                    show("Result:  " .$result);
                    //header('Location: ' . ROOT . '/AddPost?message=error');
                }
                exit;
            } else {
                header('Location: ' . ROOT . '/AddPost?message=validation_error');
                exit;
            }
        }

        $this->view('Customer/Forum/AddPost');
    }

    private function validateUploadImage($image){
        $targetDir = __DIR__ . "/../../public/assets/contentImg/"; // the path that the image stored
        $imageName = uniqid() . '_' . basename($image['name']);// create a unique name (added _) for the uploaded file
        $imagePath = $targetDir . $imageName; // combine the file path

        // Validate file size
        if ($image['size'] > self::MAX_FILE_SIZE) {
            header('Location: ' . ROOT . '/AddPost?message=file_size_exceeded');
            return false;
        }

        // Validate file extension
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, self::ALLOWED_EXTENSIONS)) {
            header('Location: ' . ROOT . '/AddPost?message=invalid_file_type');
            return false;
        }

        // Validate file type
        $fileMimeType = mime_content_type($image['tmp_name']);
        if (!in_array($fileMimeType, self::ALLOWED_MIME_TYPES)) {
            header('Location: ' . ROOT . '/AddPost?message=invalid_mime_type');
            return false;
        }

        // Ensure upload directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move uploaded file to the target directory
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            header('Location: ' . ROOT . '/AddPost?message=image_upload_error');
            return false;
        }

        return $imagePath;
    }

}
?>
