<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Likes;
use App\Models\Reply;
use Doctrine\ORM\EntityManagerInterface;

class DeletePost
{
    use Controller;

    private EntityManagerInterface $entityManager;
    private $postRepository;
    private $commentRepository;
    private $likeRepository;
    private $replyRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
        $this->replyRepository = $this->entityManager->getRepository(Reply::class);
        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
        $this->sessionManager->sessionTimeout();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postID = $_POST['postID'] ?? null;

            if ($postID) {
                // Find the post
                $post = $this->postRepository->find($postID);

                if ($post) {
                    try {
                        // Find and delete all related comments
                        $comments = $this->commentRepository->findBy(['post' => $post]);
                        foreach ($comments as $comment) {
                            // Find and delete all related replies
                            $replies = $this->replyRepository->findBy(['comment' => $comment]);
                            foreach ($replies as $reply) {
                                $this->entityManager->remove($reply);
                            }
                            $this->entityManager->remove($comment);
                        }

                        // Delete all related likes
                        $likes = $this->likeRepository->findBy(['post' => $post]);
                        foreach ($likes as $like) {
                            $this->entityManager->remove($like);
                        }

                        // Delete the post itself
                        $this->entityManager->remove($post);
                        $this->entityManager->flush();

                        // Redirect with success message
                        header("Location: " . ROOT . "/MyPost?remove=success");
                        exit;
                    } catch (\Exception $e) {
                        error_log($e->getMessage());
                        header("Location: " . ROOT . "/MyPost?remove=error");
                        exit;
                    }
                } else {
                    // Post not found
                    header("Location: " . ROOT . "/MyPost?remove=error");
                    exit;
                }
            } else {
                // Invalid post ID
                header("Location: " . ROOT . "/MyPost?remove=error");
                exit;
            }
        }
    }
}
