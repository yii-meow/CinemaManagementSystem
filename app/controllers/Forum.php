<?php

class Forum
{
    use Controller;

    public function index()
    {
        // Initialize the model to use the getAllPosts method
        $postModel = new Post();
        $commentModel = new Comment();
        $replyModel = new Reply();

        // Retrieve all posts
        $posts = $postModel->getAllPosts();
        $data = [];



        // Check if posts were retrieved and if it is an array
        if (!empty($posts) && is_array($posts)) {
            foreach ($posts as $post) {
                // Retrieve comments for each post using the Comment model
                $comments = $commentModel->getComments($post->postID) ?: [];

                // For each comment, retrieve replies using the Reply model
                foreach ($comments as &$comment) {
                    $comment->replies = $replyModel->getReplies($comment->commentID) ?: [];
                }

                // Prepare the data for each post, including its comments and replies
                $data[] = [
                    'postID' => $post->postID,
                    'userID' => $post->userID,
                    'userName' => $post->userName,
                    'profileImg' => $post->profileImg,
                    'content' => $post->content,
                    'contentImg' => $post->contentImg,
                    'postDate' => $post->postDate,
                    'comments' => $comments, // Include the comments and replies for the post
                ];
            }

            // Pass the data to the view
            $this->view('Customer/Forum/Forum', ['posts' => $data]);
        } else {
            // Handle the case where no posts are available
            $this->view('Customer/Forum/Forum', ['message' => 'Currently no posts from users.']);
        }
    }
}

?>
