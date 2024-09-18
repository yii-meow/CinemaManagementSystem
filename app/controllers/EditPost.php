<?php
namespace App\controllers;
use App\core\Controller;
class EditPost {
    use Controller;

    public function index() {
        // Check if the form is submitted to update a post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get post data from POST request
            $postId = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT);
            $content = filter_input(INPUT_POST, 'editPostContent', FILTER_SANITIZE_STRING);

            show("HERE   " . $postId);
            // Load the Post model
            $postModel = new Post();

            // Prepare updated data
            $updatedData = [
                'content' => $content
            ];

            $result = $postModel->editPost($postId, $updatedData);

            // Update the post
            if ($result) {
                // Redirect or show success message
                header('Location: ' . ROOT . '/MyPost');
                exit();
            } else {
                show($postId);
                echo 'Failed to update post.';
            }
        } else {
            // Display the edit form
            $postId = filter_input(INPUT_GET, 'postID', FILTER_SANITIZE_NUMBER_INT);

            // Load the Post model
            $postModel = new Post();

            // Fetch the post to edit
            $post = $postModel->getPostById($postId);

            if ($post) {
                // Pass post data to the view
                $data['post'] = $post;
                $this->view('Customer/Forum/MyPost', $data);
            } else {
                echo 'Post not found.';
            }
        }
    }

}
?>
