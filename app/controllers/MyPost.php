<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\models\Likes;
use App\Models\Post;
use App\Models\User; // Assuming the User entity exists
use Doctrine\ORM\EntityManagerInterface;
use App\controllers\SessionManagement;

class MyPost
{
    use Controller;

    private EntityManagerInterface $entityManager;
    private $postRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        // Initialize session management
        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
        $this->sessionManager->sessionTimeout();
    }

    // Method to fetch posts only for a particular user
    public function index()
    {
        // Start session if not started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            // Redirect to login if userId is not set
            $this->view('Customer/User/Login');
            exit();
        }

        $userId = $_SESSION['userId'];
        //$userId = 1;// temporarily hard coded
        // Fetch posts for the specific user with comments, likes, and replies
        $posts = $this->postRepository->findBy(['user' => $userId]);

        // Check if posts were retrieved
        if (!$posts) {
            $this->view('Customer/Forum/MyPost', ['posts' => []]);
            return;
        }

        $postData = [];
        foreach ($posts as $post) {
            $isLiked = $this->isPostLikedByUser($post, $userId);

            $postData[] = [
                'postID' => $post->getPostID(),
                'userName' => $post->getUser()->getUserName(),
                'profileImg' => $post->getUser()->getProfileImg(),
                'content' => $post->getContent(),
                'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
                'contentImg' => $post->getContentImg(),
                'status' => $post->getStatus(),
                'likeCount' => count($post->getLikes()),
                'isLiked' => $isLiked,
                'comments' => array_map(function ($comment) {
                    return [
                        'commentID' => $comment->getCommentID(),
                        'commentText' => $comment->getCommentText(),
                        'userName' => $comment->getCommenter()->getUserName(),
                        'profileImg' => $comment->getCommenter()->getProfileImg(),
                        'replies' => array_map(function ($reply) {
                            return [
                                'replyID' => $reply->getReplyID(),
                                'replyText' => $reply->getReplyText(),
                                'userName' => $reply->getUserReply()->getUserName(),
                                'profileImg' => $reply->getUserReply()->getProfileImg(),
                            ];
                        }, $comment->getReplies()->toArray())
                    ];
                }, $post->getComments()->toArray())
            ];
        }

        // Render the view with the post data
        $this->view('Customer/Forum/MyPost', ['posts' => $postData]);
    }

    private function isPostLikedByUser(Post $post,$userID): bool
    {
        $likeRepository = $this->entityManager->getRepository(Likes::class);
        $like = $likeRepository->findOneBy(['post' => $post, 'likedBy' => $userID]);

        return $like !== null;
    }
}
