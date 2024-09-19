<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Models\Likes;

class FilterPost
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
            $filterOption = filter_input(INPUT_POST, 'filterOptions', FILTER_SANITIZE_SPECIAL_CHARS);
            $filterType = filter_input(INPUT_POST, 'filterType', FILTER_SANITIZE_SPECIAL_CHARS);

            $userId = 4; // Hardcoded example user ID

            switch ($filterType) {
                case 'myPosts':
                    $viewName = 'Customer/Forum/MyPost';
                    break;

                case 'likedPosts':
                    $viewName = 'Customer/Forum/LikedPost';
                    break;
                    default:
                    $viewName = 'Customer/Forum/Forum';
                    break;
            }
            $posts = $this->getFilteredPosts($userId, $filterOption, $filterType);

            if (empty($posts)) {
                $this->view($viewName, ['posts' => [], 'filter' => $filterOption, 'filterType' => $filterType, 'message' => 'No posts found for the selected filter.']);
                return;
            }

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

            $this->view($viewName, ['posts' => $postData, 'filter' => $filterOption, 'filterType' => $filterType]);
        }
    }

    private function getFilteredPosts($userId, $filterOption, $filterType)
    {
        $postIds = [];

        // Handle filter type logic
        switch ($filterType) {
            case 'likedPosts':
                $postIds = $this->getLikedPosts($userId);
                break;

            case 'myPosts':
                $postIds = $this->getMyPost($userId);
                break;
            default:
                return [];
        }

        return !empty($postIds) ? $this->filterPostsByOption($filterOption, $postIds) : [];
    }

    private function getLikedPosts($userId)
    {
        $likes = $this->likeRepository->findBy(['likedBy' => $userId]);
        if (!$likes) return [];

        $postIds = array_map(function ($like) {
            return $like->getPost()->getPostID();
        }, $likes);

        return $postIds;
    }

    private function getMyPost($userId)
    {
        $posts = $this->postRepository->findBy(['user' => $userId]);
        if (!$posts) return [];

        $postIds = array_map(function ($post) {
            return $post->getPostID();
        }, $posts);

        return $postIds;
    }


    private function filterPostsByOption($filterOption, $postIds = null)
    {
        switch ($filterOption) {
            case 'latestPost':
                return $this->postRepository->filterPostsByIdsOrderedByDate($postIds, 'DESC');
            case 'oldestPost':
                return $this->postRepository->filterPostsByIdsOrderedByDate($postIds, 'ASC');
            case 'highestLikes':
                return $this->postRepository->filterPostsByIdsOrderedByLikes($postIds, 'DESC');
            case 'lowestLikes':
                return $this->postRepository->filterPostsByIdsOrderedByLikes($postIds, 'ASC');
            default:
                return $this->postRepository->filterPostsByIds($postIds);
        }
    }



  /*  private function getLikedPosts($userId, $filterOption)
    {
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

        // Apply filtering based on the selected option
        switch ($filterOption) {
            case 'latestPost':
                return $this->postRepository->filterPostsByIdsOrderedByDate($postIds, 'DESC'); // Latest posts
            case 'oldestPost':
                return $this->postRepository->filterPostsByIdsOrderedByDate($postIds, 'ASC');  // Oldest posts
            case 'highestLikes':
                return $this->postRepository->filterPostsByIdsOrderedByLikes($postIds,'DESC');       // Highest likes
            case 'lowestLikes':
                return $this->postRepository->filterPostsByIdsOrderedByLikes($postIds,'ASC');        // Lowest Likes
            default:
                return $this->postRepository->filterPostsByIds($postIds);
        }
    }*/
}
