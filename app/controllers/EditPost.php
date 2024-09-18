<?php
namespace App\controllers;
use App\core\Controller;
use App\core\Database;
use App\models\Post;

class EditPost
{
    use Controller;

    private $entityManager;
    private $postRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postID = $_POST['postID'] ?? null;
            $newContent = $_POST['editPostContent'] ?? null;

            if ($postID && $newContent) {
                $post = $this->postRepository->find($postID);

                if ($post) {
                    $post->setContent($newContent);

                    try {
                        $this->entityManager->flush();

                        header("Location: " . ROOT . "/MyPost?edit=success");
                        exit;
                    } catch (\Exception $e) {
                        header("Location: " . ROOT . "/MyPost?edit=error");
                        exit;
                    }
                } else {
                    header("Location: " . ROOT . "/MyPost?edit=error");

                    exit;
                }
            } else {
                header("Location: " . ROOT . "/MyPost?edit=error");
                exit;
            }
        }
    }
}
?>
