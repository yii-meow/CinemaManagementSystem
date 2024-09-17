<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\Comment;
use App\models\Reply;
use App\models\User;
use Doctrine\ORM\EntityManagerInterface;

class MyPost
{
    use Controller;

    private $entityManager;
    private $postRepository;
    private $commentRepository;
    private $replyRepository;
    private $userRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->replyRepository = $this->entityManager->getRepository(Reply::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function index()
    {
        // Initial debug message
        show("HELLO");

        // Temporarily hard code user ID
        $userId = 1;

        try {
            // Retrieve the User entity
            $user = $this->userRepository->find($userId);

            if ($user === null) {
                throw new \Exception("User not found with ID: " . $userId);
            }
            // Retrieve posts for the specified user
            $posts = $this->postRepository->findBy(['user' => $user]);

            if (empty($posts)) {
                $this->view('Customer/Forum/MyPost', ['message' => 'Currently no posts from users.']);
                return;
            }

            // Initialize data array
            $data = [];

            foreach ($posts as $post) {
                show("Processing post ID: " . $post->getPostID());

                // Retrieve comments for the current post
                $comments = $this->commentRepository->findBy(['post' => $post]);
                // this line onwords not working show("HI");
                // Initialize comments array for the post
                $postComments = [];

                if (!empty($comments)) {
                    show("Comment not empty");
                    foreach ($comments as $comment) {
                        // Get replies for the current comment
                        $replies = $this->replyRepository->findBy(['comment' => $comment]);

                        // Attach replies to the comment
                        $comment->replies = $replies;

                        // Add comment to postComments array
                        $postComments[] = $comment;

                        // Debug information
                        show("Number of replies for comment ID " . $comment->getCommentID() . ": " . count($replies));
                    }
                } else {
                    show("No comments found for post ID: " . $post->getPostID());
                }

                // Attach comments to the post
                $post->comments = $postComments;

                // Add the post to the data array
                $data[] = $post;
            }

            // Pass the structured data to the view
            $this->view('Customer/Forum/MyPost', ['posts' => $data]);
        } catch (\Exception $e) {
            // Handle exceptions and errors
            show("Error: " . $e->getMessage());
            $this->view('Customer/Forum/MyPost', ['message' => 'An error occurred while retrieving posts.']);
        }
    }
}
?>
