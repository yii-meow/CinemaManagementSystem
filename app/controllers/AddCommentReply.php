<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\User;
use App\models\Comment;
use App\models\Reply;


class AddCommentReply
{
    use Controller;

    private $entityManager;
    private $postRepository;
    private $commentRepository;
    private $userRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->replyRepository = $this->entityManager->getRepository(Reply::class);

    }

    public function index()
    {
        $data = ['error' => null];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = $_SESSION['userID']; // Get userID from session

            $postID = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT);
            //  $commentID = filter_input(INPUT_POST, 'commentID', FILTER_SANITIZE_NUMBER_INT);
            $commentText = filter_input(INPUT_POST, 'commentText', FILTER_SANITIZE_SPECIAL_CHARS);
            $replyText = filter_input(INPUT_POST, 'replyText', FILTER_SANITIZE_SPECIAL_CHARS);
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

            switch ($action) {
                case 'comment':
                    $this->addComment($userID, $postID, $commentText);
                    break;

                case 'reply':
                    $this->addReply($userID, $postID, $replyText);
                    break;

                default:
                    $this->view('Customer/Forum/Forum');
                    break;
            }
        } else {
            $this->view('Customer/Forum/Forum');
        }
    }

    private function addComment($userID, $postID, $commentText)
    {
        $post = $this->postRepository->find($postID);
        $user = $this->userRepository->find($userID);

        if ($post && $user) {
            $comment = new Comment();
            $comment->setPost($post)
                ->setCommentText($commentText)
                ->setCommenter($user);

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            header('Location: ' . ROOT . '/Forum?message=comment_success');
        } else {
            header('Location: ' . ROOT . '/Forum?message=comment_fail');
        }
    }

    private function addReply($userID, $postID, $replyText)
    {
        $post = $this->postRepository->find($postID);
        $user = $this->userRepository->find($userID);

        if ($post && $user) {
            // Assuming a reply needs a comment to be associated with
            $commentID = filter_input(INPUT_POST, 'commentID', FILTER_SANITIZE_NUMBER_INT);
            $comment = $this->commentRepository->find($commentID);
            show("HELELE");

            if ($comment) {
                $reply = new Reply();
                $reply->setComment($comment)
                    ->setReplyText($replyText)
                    ->setUserReply($user);

                $this->entityManager->persist($reply);
                $this->entityManager->flush();

                header('Location: ' . ROOT . '/Forum?message=reply_success');
            } else {

                header('Location: ' . ROOT . '/Forum?message=reply_fail');
            }
        } else {

            header('Location: ' . ROOT . '/Forum?message=reply_fail');
        }
    }

}

?>
