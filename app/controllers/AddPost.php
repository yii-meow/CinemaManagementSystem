<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\User;

class AddPost
{
    use Controller;

    private $entityManager;
    private $postRepository;
        const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2 MB
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png'];
    const ALLOWED_MIME_TYPES = ['image/jpeg', 'image/png'];

     public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
    }


    public function index()
    {
        $data = ['error' => null];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = 1; // Placeholder; replace with dynamic user ID retrieval
            $status = "Approved";
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
            $image = $_FILES['contentImg'] ?? null;

            if (empty($content)) {
                $data['error'] = 'Please enter your content before submitting';
            } else {
                $imagePath = null;

                if ($image && $image['error'] === UPLOAD_ERR_OK) {
                    $imagePath = $this->validateUploadImage($image);
                    if ($imagePath === false) {
                        $data['error'] = 'Invalid image file. Please check the file and try again.';
                        $this->view('Customer/Forum/AddPost', $data);
                        exit;
                    }
                }

                // Fetch the User entity
                $user = $this->entityManager->getRepository(User::class)->find($userID);
                if (!$user) {
                    $data['error'] = 'User not found. Please try again.';
                    $this->view('Customer/Forum/AddPost', $data);
                    exit;
                }

                $postData = new Post();
                $postData->setUser($user)  // Pass User object here
                ->setContent($content)
                    ->setPostDate(new \DateTime())
                    ->setContentImg($imagePath)
                    ->setStatus($status);

                try {
                    $this->entityManager->persist($postData);
                    $this->entityManager->flush();
                    header('Location: ' . ROOT . '/AddPost?message=success');
                    exit;
                } catch (\Exception $e) {
                    error_log($e->getMessage());
                    $data['error'] = 'An error occurred while saving your post. Please try again later.';
                    $this->view('Customer/Forum/AddPost', $data);
                    exit;
                }
            }
        }

        $this->view('Customer/Forum/AddPost', $data);
    }



    // Image validation and upload handling
    private function validateUploadImage($image)
    {
        $targetDir = '/assets/contentImg/'; // Store as relative path for web access
        $imageName = uniqid() . '_' . basename($image['name']);
        $imagePath = $targetDir . $imageName;

        // The physical path to save the image
        $fullImagePath = __DIR__ . "/../../public" . $imagePath;

        if ($image['size'] > self::MAX_FILE_SIZE) {
            header('Location: ' . ROOT . '/AddPost?message=file_size_exceeded');
            return false;
        }

        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, self::ALLOWED_EXTENSIONS)) {
            header('Location: ' . ROOT . '/AddPost?message=invalid_file_type');
            return false;
        }

        $fileMimeType = mime_content_type($image['tmp_name']);
        if (!in_array($fileMimeType, self::ALLOWED_MIME_TYPES)) {
            header('Location: ' . ROOT . '/AddPost?message=invalid_mime_type');
            return false;
        }

        // Check if the target directory exists, if not, create it
        if (!is_dir(dirname($fullImagePath))) {
            mkdir(dirname($fullImagePath), 0777, true);
        }

        // Move the uploaded file to the new location
        if (!move_uploaded_file($image['tmp_name'], $fullImagePath)) {
            header('Location: ' . ROOT . '/AddPost?message=image_upload_error');
            return false;
        }

        // Return the relative path that will be stored in the database
        return $imagePath;
    }

}
?>
