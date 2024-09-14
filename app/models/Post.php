<?php
class Post
{
    use Model;

    protected $table = 'Post';
    // Add Post
    public function createPost($data): bool
    {
        return $this->insert($data);
    }

    // Retrieve all posts
    public function getAllPosts()
    {
        $query = "SELECT Post.*, User.userName, User.profileImg 
                  FROM $this->table
                  JOIN User ON Post.userID = User.userId
                  ORDER BY Post.postDate DESC";

        return $this->query($query);
    }

    // Search Post
    public function searchPost($keyword)
    {
        // You can modify this to reuse the `where` method from Model if desired
        $query = "SELECT * FROM $this->table WHERE content LIKE :keyword";
        return $this->query($query, ["keyword" => "%$keyword%"]);
    }

    // Get posts of specific user (by User ID)
    public function getPostsByUserID($userId)
    {
        $query = "SELECT Post.*, User.userName, User.profileImg
              FROM $this->table AS Post
              JOIN User ON Post.userID = User.userId
              WHERE Post.userID = :userId
              ORDER BY Post.postDate DESC";

        // Retrieve posts without comments to avoid duplication
        return $this->query($query, ['userId' => $userId]);
    }


    // For post filteration
    public function getFilteredPosts($filterOption)
    {
        // Base query
        $query = "SELECT * FROM $this->table";

        // Add filter condition to the query
        switch ($filterOption) {
            case 'latestPost':
                $query .= " ORDER BY postDate DESC";
                break;
            case 'highestLikes':
                $query .= " ORDER BY likeCount DESC"; // Ensure you have a likeCount column
                break;
            case 'oldestPost':
                $query .= " ORDER BY postDate ASC";
                break;
            default:
                $query .= " ORDER BY postDate DESC"; // Default filter
                break;
        }

        return $this->query($query);
    }

    //Get post by postID
    public function getPostById($postID){
    $query = "SELECT * FROM $this->table WHERE postID = :postID";
    return $this->query($query, ['postID' => $postID]);
    }

    //Update post
    /*public function editPost($postID, $content){
        $query = "UPDATE $this->table SET content = :content WHERE postID = :postID";

        $result = $this->query($query, ["content" => $content, "postID" => $postID]);
        show("query here" . $result);
        return $result;


    }*/
    public function editPost($postID, $data) {
        // Use the update method from the Model trait and pass the correct id_column
        return $this->update($postID, $data, 'postID');
    }



    public function deletePost($postID){

        return $this->delete($postID, 'postID');
    }
}





//Add Post
    /*public function createPost($data)
    {
        // SQL query to insert a new post
        $query = "INSERT INTO Post (userID, content, contentImg, status) 
              VALUES (3, :content, :contentImg, 'Approved')";  // userID is temporarily hardcoded as 3

        // Execute the query and return the result
        $result = $this->query($query, $data); // $result is empty
        return $result;

    }

    // Retrieve all posts
    public function getAllPosts()
    {
        $query = "SELECT Post.*, User.userName, User.profileImg 
                  FROM Post 
                  JOIN User ON Post.userID = User.userId
                  ORDER BY Post.postDate DESC";

        $result = $this->query($query);
        return $result;
    }

    // Search Post
    public function searchPost($keyword){
        $query = "SELECT * FROM Post WHERE content LIKE :keyword";

        $result = $this->query($query, ["keyword" => "%$keyword%"]);
        return $result;
    }

    // Retrieve comments for a specific post
    public function getComments($postId)
    {
        $query = "SELECT Comment.*, User.userName, User.profileImg 
                  FROM Comment 
                  JOIN User ON Comment.commenterID = User.userId
                  WHERE Comment.postID = :postID";
        return $this->query($query, $postId);
    }

    // Retrieve replies for a specific comment
    public function getReplies($commentId)
    {
        $query = "SELECT Reply.*, User.userName, User.profileImg 
                  FROM Reply 
                  JOIN User ON Reply.replyUserID = User.userId
                  WHERE Reply.commentID = :commentID";
        return $this->query($query, $commentId);
    }
}*/
    ?>