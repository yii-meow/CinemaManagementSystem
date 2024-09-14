<?php
class Comment {
use Model;

    protected $table = 'Comment';
    // Retrieve comments for a specific post
    public function getComments($postId)
    {
        $query = "SELECT Comment.*, User.userName, User.profileImg 
                  FROM Comment 
                  JOIN User ON Comment.commenterID = User.userId
                  WHERE Comment.postID = :postID";
        return $this->query($query, ['postID' => $postId]);
    }

public function getCommentsOfLikedPost($postID,$userID) {
    $query = "SELECT Comment.*, User.userName, User.profileImg
              FROM Comment
              INNER JOIN User ON Comment.commenterID = User.userId
              INNER JOIN Likes ON Likes.postID = Comment.postID
              WHERE Comment.postID = :postID AND Likes.likedBy = :userID";

    return $this->query($query, ['postID' => $postID, 'userID' => $userID]);
}

public function deleteCommentByPostID($postID) {
        return $this->delete($postID, 'postID');
}

    public function getCommentByPostID($postID) {
        $query = "SELECT commentID FROM Comment WHERE postID = :postID";
        $result = $this->query($query, ['postID' => $postID]);

        // Return an empty array if no comments are found or if an error occurs
        return is_array($result) ? $result : [];
    }


}
?>