<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Post;
use Doctrine\ORM\EntityManagerInterface;

class Forum
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
        try {
            show("STARTTTTTTT");
            // Retrieve all posts with comments, likes, and replies
            $posts = $this->postRepository->findAllWithDetails();
            //!!!!!!!!!!!!!!here got issue
            show("HELLO");

            // Ensure there are posts to process
            if (empty($posts)) {
                throw new \Exception("No posts found.");
            }

            // Transform the post entities into an array with content details, comments, likes, and replies
            $postData = array_map(function (Post $post) {
                $comments = $post->getComments()->toArray();
                $likes = $post->getLikes()->count();
                return [
                    'postID' => $post->getPostID(),
                    'content' => $post->getContent(),
                    'contentImg' => $post->getContentImg(),
                    'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
                    'comments' => array_map(function ($comment) {
                        $replies = $comment->getReplies()->toArray();
                        return [
                            'commentID' => $comment->getCommentID(),
                            'commentText' => $comment->getCommentText(),
                            'userName' => $comment->getUser()->getUserName(),
                            'profileImg' => $comment->getUser()->getProfileImg(),
                            'replies' => array_map(function ($reply) {
                                return [
                                    'replyText' => $reply->getReplyText(),
                                    'userName' => $reply->getUser()->getUserName(),
                                    'profileImg' => $reply->getUser()->getProfileImg(),
                                ];
                            }, $replies),
                        ];
                    }, $comments),
                    'likeCount' => $likes,
                ];
            }, $posts);

            // Prepare data to pass to the view
            $data['posts'] = $postData;

            // Render the view with the data
            $this->view('Customer/Forum/Forum', $data);

        } catch (\Exception $e) {
            // Handle any exceptions by logging and displaying an error message
            error_log($e->getMessage());
            show("FAILLLLLLLLLLLLLLL");

           // $this->view('Customer/Forum/Forum', ['message' => 'An error occurred while retrieving posts.']);
        }
    }
}
?>
