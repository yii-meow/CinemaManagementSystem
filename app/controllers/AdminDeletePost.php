<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Likes;
use App\Models\Reply;
use Doctrine\ORM\EntityManagerInterface;

class AdminDeletePost
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
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postID = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);

            show($postID);

            if ($postID) {
                // Find the post
                $post = $this->postRepository->find($postID);

                if ($post) {
                    show("FDound");
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
                        show("DLT C & R");

                        // Delete all related likes
                        $likes = $this->likeRepository->findBy(['post' => $post]);
                        foreach ($likes as $like) {
                            $this->entityManager->remove($like);
                        }


                        // Delete the post itself
                        $this->entityManager->remove($post);
                        show("DLETE");
                        $this->entityManager->flush();
                        show("ALLODNE");

                        // Redirect with success message
                        header('Location: ' . ROOT . '/AdminForum?remove=success');
                        //redirect("/AdminForum/index");

                        exit;
                    } catch (\Exception $e) {
                        // Log the exception and redirect with error message
                        error_log($e->getMessage());
                        header('Location: ' . ROOT . '/AdminForum?remove=error');
                        exit;
                    }
                } else {
                    show("POST NOT FOUND");
                    // Post not found, redirect with error message
                   header('Location: ' . ROOT . '/AdminForum?remove=error');
                    exit;
                }
            } else {
                // Invalid post ID, redirect with error message
                show("Invalid ID". $postID);

                header('Location: ' . ROOT . '/AdminForum?remove=error');
                exit;
            }
        }
    }
}
