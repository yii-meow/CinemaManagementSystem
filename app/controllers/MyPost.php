<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use App\Models\User; // Assuming the User entity exists
use Doctrine\ORM\EntityManagerInterface;

class MyPost
{
    use Controller;

    private EntityManagerInterface $entityManager;
    private $postRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
    }

    // Method to fetch posts only for a particular user
    public function index()
    {
        $userId = 1;// temporarily hard coded
        // Fetch posts for the specific user with comments, likes, and replies
        $posts = $this->postRepository->findBy(['user' => $userId]);

        // Check if posts were retrieved
        if (!$posts) {
            $this->view('Customer/Forum/MyPost', ['posts' => []]);
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

        // Render the view with the post data
        $this->view('Customer/Forum/MyPost', ['posts' => $postData]);
    }
}
