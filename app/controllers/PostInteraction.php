<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Comment;
use App\models\Post;
use App\models\Likes;
use App\models\Reply;
use App\models\User;
use App\Observers\LikeObserver;
use App\Observers\PostSubject;
use App\Observers\CommentObserver;
use App\controllers\SessionManagement;
use App\Observers\ReplyObserver;

class PostInteraction
{
    use Controller;

    private $entityManager;
    private $postRepository;
    private $likeSubject;
    private $userRepository;
    private $commentRepository;
    private $replyRepository;

    private $likeObserver;


    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->replyRepository = $this->entityManager->getRepository(Reply::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);


        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
        $this->sessionManager->sessionTimeout();

        // Initialize PostSubject and attach observers
        $this->likeSubject = new PostSubject();
        $this->likeSubject->attach(new LikeObserver());
        $this->likeSubject->attach(new CommentObserver());
        $this->likeSubject->attach(new ReplyObserver());
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userID = $_SESSION['userId'];
            $postID = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT);
            //  $commentID = filter_input(INPUT_POST, 'commentID', FILTER_SANITIZE_NUMBER_INT);
            $commentText = filter_input(INPUT_POST, 'commentText', FILTER_SANITIZE_SPECIAL_CHARS);
            $replyText = filter_input(INPUT_POST, 'replyText', FILTER_SANITIZE_SPECIAL_CHARS);
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

            switch ($action) {
                case 'comment':
                    $this->addComment($userID, $postID, $commentText);
                    break;

                case 'reply':
                    $this->addReply($userID, $postID, $replyText);
                    break;

                default:
                    $this->view('Customer/Forum/Forum');
                    break;
            }
        } else {
            $this->view('Customer/Forum/Forum');
        }
    }

    private function addComment($userID, $postID, $commentText)
    {
        // Validate input
        if ($postID && $commentText && $userID) {
            // Find the post and user
            $post = $this->postRepository->find($postID);
            $user = $this->userRepository->find($userID);

            // Notify observers of the new comment
            $this->likeSubject->addComment($user, $post, $commentText);
        } else {
            header('Location: ' . ROOT . '/Forum?message=comment_fail');
        }

    }

    private function addReply($userID, $postID, $replyText)
    {
        $post = $this->postRepository->find($postID);
        $user = $this->userRepository->find($userID);

        if ($post && $user) {
            // Get the comment ID from the request
            $commentID = filter_input(INPUT_POST, 'commentID', FILTER_SANITIZE_NUMBER_INT);
            $comment = $this->commentRepository->find($commentID);

            // Check if the comment exists
            if ($comment) {
                $this->likeSubject->addReply($user, $comment, $replyText);
            } else {
                header('Location: ' . ROOT . '/Forum?message=reply_fail');
                exit; // Always use exit after a header redirect
            }
        } else {
            header('Location: ' . ROOT . '/Forum?message=reply_fail');
            exit;
        }
    }

    public function likeAction()
    {
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

        // Perform like action
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
    }
}

?>
