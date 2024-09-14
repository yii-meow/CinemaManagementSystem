<?php

class MyPost
{
    use Controller;

    public function index()
    {
        $userId = 1; // Temporarily hard code user ID

        // Initialize the Post, Comment, and Reply models
        $postModel = new Post();
        $commentModel = new Comment();
        $replyModel = new Reply();

        // Retrieve posts for the specified user
        $posts = $postModel->getPostsByUserID($userId);

        // Organize posts, comments, and replies
        $data = [];

        // Check if posts were retrieved and if it is an array
        if (!empty($posts) && is_array($posts)) {
            foreach ($posts as $post) {
                // Retrieve comments for each post using the Comment model
                $comments = $commentModel->getComments($post->postID) ?: [];

                // For each comment, retrieve replies using the Reply model
                foreach ($comments as &$comment) {
                    // Get replies for the current comment
                    $comment->replies = $replyModel->getReplies($comment->commentID) ?: [];
                }

                // Attach comments to the post
                $post->comments = $comments;

                // Add the post to the data array
                $data[] = $post;
            }

            // Pass the structured data to the view
            $this->view('Customer/Forum/MyPost', ['posts' => $data]);
        } else {
            // Handle the case where no posts are available
            $this->view('Customer/Forum/MyPost', ['message' => 'Currently no posts from users.']);
        }
    }


}
?>
