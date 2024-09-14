<?php
class Reply
{
    use Model;
    protected $table = 'Reply';
    public function getReplies($commentId)
    {
        $query = "SELECT Reply.*, User.userName, User.profileImg 
                  FROM Reply 
                  JOIN User ON Reply.replyUserID = User.userId
                  WHERE Reply.commentID = :commentID";
        return $this->query($query, ['commentID' => $commentId]);
    }
    public function getRepliesOfLikedPost($commentID,$userID)
    {
        $query = "SELECT Reply.*, User.userName, User.profileImg
              FROM Reply
              INNER JOIN User ON Reply.replyUserID = User.userId
              INNER JOIN Comment ON Reply.commentID = Comment.commentID
              INNER JOIN Likes ON Likes.postID = Comment.postID
              WHERE Reply.commentID = :commentID AND Likes.likedBy = :userID";

        return $this->query($query, ['commentID' => $commentID, 'userID' => $userID]);
    }

    public function deleteReplyByCommentID($commentID)
    {
        if (is_object($commentID)) {
            $commentID = $commentID->commentID; // Adjust to extract the scalar value from the object
        }

        return $this->delete($commentID, 'commentID');
    }

}
?>