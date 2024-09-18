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
    const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png'];
    const ALLOWED_MIME_TYPES = ['image/jpeg', 'image/png'];

     public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
    }


    public function index()
    {
        $data = ['error' => null, 'errorMessage' => null];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = 1; // Placeholder; replace with dynamic user ID retrieval
            $status = "Approved";
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
            $image = $_FILES['contentImg'] ?? null;

            if (empty($content)) {
                header('Location: ' . ROOT . '/AddPost?message=validation_error');
            } else {
                $imagePath = null;

                if ($image && $image['error'] === UPLOAD_ERR_OK) {
                    $uploadResult = $this->validateUploadImage($image);

                    if (isset($uploadResult['error'])) {
                        $data['errorMessage'] = $uploadResult['error'];
                    } else {
                        $imagePath = $uploadResult['imagePath'];
                    }
                } elseif ($image['error'] !== UPLOAD_ERR_NO_FILE) {
                    // when image is not uploaded but an error occurr
                    header('Location: ' . ROOT . '/AddPost?message=image_upload_error');
                }

                // Fetch User entity
                $user = $this->entityManager->getRepository(User::class)->find($userID);
                if (!$user) {
                    $data['error'] = 'User not found. Please try again.';
                    $this->view('Customer/Forum/AddPost', $data);
                    exit;
                }

                // Only proceed if there are no errors
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
        $targetDir = '/uploads/'; // Store as relative path for web access
        $imageName = bin2hex(random_bytes(16))  . '_' . basename($image['name']); // to generate unique filename
        $imagePath = $targetDir . $imageName;

        // Physical path to save the image
        $fullImagePath = __DIR__ . '../../..'. $imagePath;

        // Validate file size
        if ($image['size'] > self::MAX_FILE_SIZE) {
            return '*File size exceeded the maximum limit.';
        }

        // Validate file extension
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, self::ALLOWED_EXTENSIONS)) {
            return '*Invalid file type. Allowed types are: ' . implode(', ', self::ALLOWED_EXTENSIONS);
        }

        // Validate mime content type
        $fileMimeType = mime_content_type($image['tmp_name']); //ensure uploaded file is allowed type
        if (!in_array($fileMimeType, self::ALLOWED_MIME_TYPES)) {
            return '*Invalid file type. Allowed mime types are: ' . implode(', ', self::ALLOWED_MIME_TYPES);
        }

        // Check if the target directory exists, if not, create it
        if (!is_dir(dirname($fullImagePath))) {
            mkdir(dirname($fullImagePath), 0777, true);
        }

        // Move the uploaded file to the new location
        if (!move_uploaded_file($image['tmp_name'], $fullImagePath)) {
            return '*Error moving the uploaded file.';
        }

        return ['imagePath' => $imagePath];    // no err
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
            header('Location: ' . ROOT . '/AddPost?message=success');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            header('Location: ' . ROOT . '/AddPost?message=error');
        }
    }

}
?>
