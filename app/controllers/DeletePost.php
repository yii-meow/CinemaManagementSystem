<?php

class DeletePost
{
    use Controller;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postId = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT);

            // Instantiate models
            $postModel = new Post();
            $commentModel = new Comment();
            $replyModel = new Reply();
            $likeModel = new Likes(); // Added model to handle likes

            try {
                // Delete likes related to the post
                $likeModel->deleteLikesByPostID($postId);

                // Retrieve comments related to the post
                $comments = $commentModel->getCommentByPostID($postId);

                // Ensure $comments is an array or object before iterating
                if (is_array($comments) || is_object($comments)) {
                    // Delete replies related to each comment
                    foreach ($comments as $comment) {
                        $replyModel->deleteReplyByCommentID($comment->commentID);
                    }
                } else {
                    // Handle case where $comments is not an array
                    throw new Exception('Error retrieving comments.');
                }

                // Delete comments related to the post
                $commentModel->deleteCommentByPostID($postId);

                // Delete the post itself
                $result = $postModel->deletePost($postId);

                if ($result) {
                    header('Location: ' . ROOT . '/MyPost');
                    exit();
                } else {
                    echo 'Failed to delete post.';
                }
            } catch (Exception $e) {
                echo 'An error occurred: ' . $e->getMessage();
            }
        } else {
            echo 'Invalid request.';
        }
    }
}
?>
