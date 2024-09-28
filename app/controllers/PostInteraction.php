<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\User;
use App\Observers\LikeObserver;
use App\Observers\LikeSubject;

class PostInteraction
{
    use Controller;

    private $entityManager;
    private $postRepository;
    private $likeSubject;
    private $userRepository;

    public function __construct() {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);

        //1 create the concrete subject
        $this->likeSubject = new LikeSubject();

        // 2 attach observer (LikeObserver) to subject
        $this->likeSubject->attach(new LikeObserver($this->likeSubject)); // passing LikeSubject into its constructor
    }

    // 4 When user perform like action
    public function likeAction() {
        // Get the POST data
        $userID = $_POST['userID'] ?? null;
        $postID = $_POST['postID'] ?? null;

        // Validate input
        if (!$userID || !$postID) {
            echo json_encode(['error' => 'User ID or Post ID is missing']);
            return;
        }

        // Find user and post
        $user = $this->userRepository->find($userID);
        $post = $this->postRepository->find($postID);

        if (!$user || !$post) {
            echo json_encode(['error' => 'User or Post not found']);
            return;
        }

        // 5 Call the likePost method in LikeSubject followed by user and post data
        $this->likeSubject->likePost($user, $post);

        // Prepare response
        $response = [
            'success' => true,
            'isLiked' => $this->likeSubject->isLiked($user, $post),
            'likeCount' => $post->getLikes()->count()
        ];

        // Output JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
        return;
    }

}
