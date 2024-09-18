<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use Doctrine\ORM\EntityManagerInterface;
use App\controllers\SessionManagement;

class Forum
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

    public function index()
    {
        // Fetch all posts with comments, likes, and replies
        $posts = $this->postRepository->findAllPostsWithCommentsLikes();

        if (!$posts) {
            $this->view('Customer/Forum/Forum', ['posts' => []]);
            return;
        }

        $postData = [];
        foreach ($posts as $post) {
            $postData[] = [
                'postID' => $post->getPostID(),
                'userName' => $post->getUser()->getUserName(),
                'profileImg' => $post->getUser()->getProfileImg(),
                'content' => $post->getContent(),
                'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
                'contentImg' => $post->getContentImg(),
                'status' => $post->getStatus(),
                'likeCount' => count($post->getLikes()),
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

        $this->view('Customer/Forum/Forum', ['posts' => $postData]);
    }
}
