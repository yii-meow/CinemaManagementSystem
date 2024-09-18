<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
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


        // Fetch all posts without comments, likes, and replies
        $posts = $this->postRepository->findAll();

        // Prepare the data for the view
        $postData = [];
        foreach ($posts as $post) {
            $postData[] = [
                'content' => $post->getContent(),
                'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
                'contentImg' => $post->getContentImg(),
                'status' => $post->getStatus()
            ];
        }
       /* // Fetch all posts with comments, likes, and replies
        $posts = $this->postRepository->findAllPostsWithRelations();

        // Prepare the data for the view
        $postData = [];
        foreach ($posts as $post) {
            $postData[] = [
                'postID' => $post->getPostID(),
                'userName' => $post->getUser()->getUserName(), // Assuming getUserName() exists
                'profileImg' => $post->getUser()->getProfileImg(), // Assuming getProfileImg() exists
                'content' => $post->getContent(),
                'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
                'contentImg' => $post->getContentImg(),
                'status' => $post->getStatus(),
                'likeCount' => count($post->getLikes()),
                'comments' => array_map(function ($comment) {
                    return [
                        'commentID' => $comment->getCommentID(),
                        'commentText' => $comment->getCommentText(),
                        'userName' => $comment->getCommenter()->getUserName(), // Assuming getUserName() exists
                        'profileImg' => $comment->getCommenter()->getProfileImg(), // Assuming getProfileImg() exists
                        'replies' => array_map(function ($reply) {
                            return [
                                'replyID' => $reply->getReplyID(),
                                'replyText' => $reply->getReplyText(),
                                'userName' => $reply->getReplyUser()->getUserName(), // Assuming getUserName() exists
                                'profileImg' => $reply->getReplyUser()->getProfileImg(), // Assuming getProfileImg() exists
                            ];
                        }, $comment->getReplies()->toArray())
                    ];
                }, $post->getComments()->toArray())
            ];
        }
*/
        // Render the view with the post data
        $this->view('Customer/Forum/Forum', ['posts' => $postData]);
    }
}
