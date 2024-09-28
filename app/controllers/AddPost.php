<?php
/**
 * @author Angeline Chuang May Teng
 */
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
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png']; // allowed file type and extensions
    const ALLOWED_MIME_TYPES = ['image/jpeg', 'image/png'];

     public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
        $this->sessionManager->sessionTimeout();
    }


    public function index()
    {
        $data = ['error' => null, 'errorMessage' => null];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Start session if not started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Check if userId is set in the session
            if (!isset($_SESSION['userId'])) {
                // Redirect to login if userId is not set
                $this->view('Customer/User/Login');
                exit();
            }

            // retrieve data form form
            $userID = $_SESSION['userId'];
            $status = "Approved"; // default
            $content = filter_input(INPUT_POST,'content',FILTER_SANITIZE_SPECIAL_CHARS);
            $image = $_FILES['contentImg'] ?? null;

            // if no content inserted, redirect with Error
            if (empty($content)) {
                header('Location: ' . ROOT . '/AddPost?message=validation_error');
            } else {
                // validate image
                $imagePath = null;

                if ($image && $image['error'] === UPLOAD_ERR_OK) {
                    // validated via validateUploadImage()
                    $uploadResult = $this->validateUploadImage($image);

                    if (isset($uploadResult['error'])) {
                        $data['errorMessage'] = $uploadResult['error'];
                    } else {
                        $imagePath = $uploadResult['imagePath'];
                    }
                } elseif (isset($image['error']) && $image['error'] !== UPLOAD_ERR_NO_FILE) {
                    redirect("\Error404\index");
                }

                $user = $this->entityManager->getRepository(User::class)->find($userID);
                if (!$user) {
                    $data['error'] = 'User not found. Please try again.';
                    $this->view('Customer/Forum/AddPost', $data);
                    exit;
                }

                if (!$data['errorMessage'] && !$data['error']) {
                    $this->storePost($user, $content, $status, $imagePath, $data);
                }
            }
        }

        $this->view('Customer/Forum/AddPost', $data);
    }


    // Image validation and upload handling
    private function validateUploadImage($image)
    {
        $targetDir = '/storage/uploads/';
        //generate 16 random bytes of data and convert them into a hexadecimal string
        $imageName = bin2hex(random_bytes(16))  . '_' . basename($image['name']);
        $imagePath = $targetDir . $imageName;
        $fullImagePath = __DIR__ . '../../..'. $imagePath;

        // Validate file size not exceed 2MB
        if ($image['size'] > self::MAX_FILE_SIZE) {
            return ['error' => '*File size exceeded the maximum limit.'];
        }

        // Validate file extension (only jpg, png, jpeg)
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));// extract uploaded image's extension
        if (!in_array($fileExtension, self::ALLOWED_EXTENSIONS)) {// in_array -> check the value exists in an array
            return ['error' => '*Invalid file type. Allowed types are: ' . implode(', ', self::ALLOWED_EXTENSIONS)];
        }

        // Validate mime content type
        $fileMimeType = mime_content_type($image['tmp_name']); // temp location that store the image
        if (!in_array($fileMimeType, self::ALLOWED_MIME_TYPES)) {
            return ['error' => '*Invalid mime type. Allowed types are: ' . implode(', ', self::ALLOWED_MIME_TYPES)]; //mplode -> merge string
        }

        // Move the uploaded file to the new location
        if (!move_uploaded_file($image['tmp_name'], $fullImagePath)) {
            return ['error' => '*Error moving the uploaded file.'];
        }

        return ['imagePath' => $imagePath];
    }

    private function storePost($user, $content, $status, $imagePath, &$data)
    {
        $postData = new Post();
        $postData->setUser($user)
                 ->setContent($content)
                 ->setPostDate(new \DateTime())
                 ->setContentImg($imagePath)
                 ->setStatus($status);

        try {
            $this->entityManager->persist($postData);
            $this->entityManager->flush();
            header('Location: ' . ROOT . '/Forum?add=success');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            header('Location: ' . ROOT . '/AddPost?message=error');
        }
    }

}
?>
