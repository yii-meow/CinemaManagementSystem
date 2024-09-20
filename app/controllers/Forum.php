<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\models\Likes;
use App\Models\Post;
use App\models\User;
use Doctrine\ORM\EntityManagerInterface;
use App\controllers\SessionManagement;

class Forum
{
    use Controller;

    private EntityManagerInterface $entityManager;
    private $postRepository;
    private $userRepository;


    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);

        // Initialize session management
        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
       $this->sessionManager->sessionTimeout();
    }

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

        $user = $this->userRepository->find($userId);

        // Fetch all posts with comments, likes, and replies
        $posts = $this->postRepository->findAllPostsWithCommentsLikes();

        if (!$posts) {
            $this->view('Customer/Forum/Forum', ['posts' => []]);
            return;
        }

        $postData = [];
        foreach ($posts as $post) {
            $isLiked = $this->isPostLikedByUser($post, $user);

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

       $this->view('Customer/Forum/Forum', [
            'posts' => $postData,
            'user' => $user
        ]);
        }

    private function isPostLikedByUser(Post $post, User $user): bool
    {
        $likeRepository = $this->entityManager->getRepository(Likes::class);
        $like = $likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);

        return $like !== null;
    }
}
