<?php
class LikedPost {
    use Controller;

    public function index() {
        $userID = 1; // temporary hard coded
        $likesModel = new Likes();
        $commentModel = new Comment();
        $replyModel = new Reply();

        // Fetch liked posts by the user
        $posts = $likesModel->getLikedPostByUserID(['userID' => $userID]);

        // Prepare an array to hold posts with comments and replies
        $postsArray = [];

        foreach ($posts as $postItem) {
            // Initialize post item in array
            if (!isset($postsArray[$postItem->postID])) {
                // Add the post data to the array
                $postsArray[$postItem->postID] = $postItem;

                // Fetch comments only for liked posts by this user
                $postsArray[$postItem->postID]->comments = $commentModel->getCommentsOfLikedPost($postItem->postID, $userID);

                // Fetch replies for each comment within the liked post
                if (!empty($postsArray[$postItem->postID]->comments)) {
                    foreach ($postsArray[$postItem->postID]->comments as &$comment) {
                        $comment->replies = $replyModel->getRepliesOfLikedPost($comment->commentID, $userID);
                    }
                }
            }
        }

        // Convert associative array back to indexed array
        $posts = array_values($postsArray);

        // Pass the posts data to the view
        $this->view('Customer/Forum/LikedPost', ['posts' => $posts]);
    }
}
