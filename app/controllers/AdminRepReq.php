<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Comment;
use App\models\Likes;
use App\models\Post;
use App\models\Reply;
use App\models\ReportRequest;
use App\repositories\PostRepository;
use App\repositories\ReportRepository;
use Doctrine\ORM\EntityManager;

class AdminRepReq
{
    use Controller;

    private EntityManager $entityManager;
    private PostRepository $postRepository;
    private ReportRepository $reportRepository;
    private $likeRepository;
    private $replyRepository;
    private $commentRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->reportRepository = $this->entityManager->getRepository(ReportRequest::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
        $this->replyRepository = $this->entityManager->getRepository(Reply::class);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
            $postID = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_SPECIAL_CHARS);

            // Find the post based on postID
            $post = $this->postRepository->find($postID);

            if ($post) {
                // Find the corresponding report request
                $reportRequest = $this->reportRepository->findOneBy(['post' => $post]);

                if ($action === 'approve') {
                    $this->removePost($postID);
                } elseif ($action === 'reject') {
                    // Admin rejects the report request -> change post status to 'Rejected'
                    $post->setStatus('Rejected');
                    $this->entityManager->persist($post);
                    $this->entityManager->flush();

                    // Remove the report request
                    if ($reportRequest) {
                        $this->entityManager->remove($reportRequest);
                        $this->entityManager->flush();
                    }

                    header('Location: ' . ROOT . '/AdminForum?remove=reject');
                    $this->showSuccess('Post has been marked as Rejected.');
                } else {
                    // Handle unexpected action
                    $this->showError('Invalid action.');
                }
            } else {
                show("POST NOT FOUND");
                // Post not found, redirect with error message
                header('Location: ' . ROOT . '/AdminForum?remove=error');
                exit;
            }
        }
    }

    private function removePost($postID)
    {
        $post = $this->postRepository->find($postID);
        if ($post) {
            try {
                // Find and delete all related comments
                // Remove the corresponding report request
                $reportRequest = $this->reportRepository->findOneBy(['post' => $post]);
                if ($reportRequest) {
                    $this->entityManager->remove($reportRequest);
                    $this->entityManager->flush();
                }

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


                header('Location: ' . ROOT . '/AdminForum?remove=success');
                exit;
            } catch (\Exception $e) {
                error_log($e->getMessage());
                header('Location: ' . ROOT . '/AdminForum?remove=error');
                exit;
            }
        } else {
            // Post not found
            header('Location: ' . ROOT . '/AdminForum?remove=error');
            exit;
        }
    }
}
