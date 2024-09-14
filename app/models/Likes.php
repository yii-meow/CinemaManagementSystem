<?php
class Likes{
    use Model;
    protected $table = 'Likes';


    // to retrieve the post that liked by the user followed by the post's owner info
    public function getLikedPostByUserID($data){
        $query = "SELECT Post.*, User.userName, User.profileImg 
                  FROM Likes 
                  INNER JOIN Post ON Likes.postID = Post.postID
                  INNER JOIN User ON Post.userID = User.userID
                  WHERE Likes.likedBy = :userID";

        return $this->query($query, ['userID' => $data['userID']]);
    }

    public function deleteLikesByPostID($postID)
    {
        // Use the delete method from the Model trait
        return $this->delete($postID, 'postID');
    }
}
?>