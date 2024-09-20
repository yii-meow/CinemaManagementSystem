<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use App\Models\Likes;
use App\models\User;
use Doctrine\ORM\EntityManagerInterface;
use App\controllers\SessionManagement;

class ShowLikedPost
{
    use Controller;

    private EntityManagerInterface $entityManager;
    private $postRepository;
    private $likeRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
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

        // Fetch posts liked by the specific user
        $likedPosts = $this->likeRepository->findBy(['likedBy' => $userId]);

        if (!$likedPosts) {
            $this->view('Customer/Forum/LikedPost', ['posts' => []]);
            return;
        }

        $postData = [];
        foreach ($likedPosts as $like) {

            $post = $like->getPost();
            $isLiked = true;

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

        $this->view('Customer/Forum/LikedPost', ['posts' => $postData]);
    }

}
