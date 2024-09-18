<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use App\repositories\PostRepository;
use App\Models\Likes;

class SearchPost
{
    use Controller;

    protected $entityManager;
    protected PostRepository $postRepository;
    protected $likeRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keyword = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
            $searchType = filter_input(INPUT_POST, 'searchType', FILTER_SANITIZE_STRING);

            // Decide search logic based on the hidden input
            switch ($searchType) {
                case 'myPost':
                    $posts = $this->getMyPosts($keyword);
                    $viewName = 'Customer/Forum/MyPost';
                    break;

                case 'likedPost':
                    $posts = $this->getLikedPosts($keyword);
                    $viewName = 'Customer/Forum/LikedPost';
                    break;
                case 'adminView':
                    $posts = $this->getAllPosts($keyword);
                    $viewName = 'Admin/Forum/ForumManagement';
                    break;

                case 'allPosts':
                default:
                    $posts = $this->getAllPosts($keyword);
                    $viewName = 'Customer/Forum/Forum';
                    break;
            }

            // Handle empty search result scenario
            if (!$posts) {
                $this->view($viewName, ['posts' => [], 'keyword' => $keyword]);
                return;
            }

            // Process and display posts as before
            $postData = [];
            foreach ($posts as $post) {
                $postData[] = [
                    'postID' => $post->getPostID(),
                    'userName' => $post->getUser()->getUserName(),
                    'profileImg' => $post->getUser()->getProfileImg(),
                    'content' => $post->getContent(),
                    'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
                    'contentImg' => $post->getContentImg(),
                    'status' => $post->getStatus(),
                    'likeCount' => count($post->getLikes()),
                    'comments' => array_map(function ($comment) {
                        return [
                            'commentID' => $comment->getCommentID(),
                            'commentText' => $comment->getCommentText(),
                            'userName' => $comment->getCommenter()->getUserName(),
                            'profileImg' => $comment->getCommenter()->getProfileImg(),
                            'replies' => array_map(function ($reply) {
                                return [
                                    'replyID' => $reply->getReplyID(),
                                    'replyText' => $reply->getReplyText(),
                                    'userName' => $reply->getUserReply()->getUserName(),
                                    'profileImg' => $reply->getUserReply()->getProfileImg(),
                                ];
                            }, $comment->getReplies()->toArray())
                        ];
                    }, $post->getComments()->toArray())
                ];
            }

            // Render the view with the filtered post data
            $this->view($viewName, ['posts' => $postData, 'keyword' => $keyword]);
        }
    }

    private function getMyPosts($keyword)
    {
        $userId = 4; // Example hard-coded user ID
        return $this->postRepository->findPostsByUserAndKeyword($userId, $keyword);
    }

    private function getLikedPosts($keyword)
    {
        $userId = 4; // Example hard-coded user ID
        $likes = $this->likeRepository->findBy(['likedBy' => $userId]);

        if (!$likes) {
            return [];
        }

        $postIds = array_map(function ($like) {
            return $like->getPost()->getPostID();
        }, $likes);

        if (empty($postIds)) {
            return [];
        }

        return $this->postRepository->findPostsByIdsAndKeyword($postIds, $keyword);
    }

    private function getAllPosts($keyword)
    {
        return $this->postRepository->findPostsByKeyword($keyword);
    }





}
