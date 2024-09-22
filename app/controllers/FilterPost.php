<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Models\Likes;

class FilterPost
{
    use Controller;

    private $entityManager;
    private PostRepository $postRepository;
    private $likeRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
        $this->sessionManager->sessionTimeout();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filterOption = filter_input(INPUT_POST, 'filterOptions', FILTER_SANITIZE_SPECIAL_CHARS);
            $filterType = filter_input(INPUT_POST, 'filterType', FILTER_SANITIZE_SPECIAL_CHARS);

            $userID = $_SESSION['userId'];

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
            $posts = $this->getFilteredPosts($userID, $filterOption, $filterType);

            if (empty($posts)) {
                $this->view($viewName, ['posts' => [], 'filter' => $filterOption, 'filterType' => $filterType, 'message' => 'No posts found for the selected filter.']);
                return;
            }

            $postData = [];
            foreach ($posts as $post) {
                $isLiked = $this->isPostLikedByUser($post, $userID);
                $postData[] = [
                    'postID' => $post->getPostID(),
                    'userName' => $post->getUser()->getUserName(),
                    'profileImg' => $post->getUser()->getProfileImg(),
                    'content' => $post->getContent(),
                    'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
                    'contentImg' => $post->getContentImg(),
                    'status' => $post->getStatus(),
                    'likeCount' => count($post->getLikes()),
                    'isLiked' => $isLiked,
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

    private function isPostLikedByUser(Post $post,$userID): bool
    {
        $likeRepository = $this->entityManager->getRepository(Likes::class);
        $like = $likeRepository->findOneBy(['post' => $post, 'likedBy' => $userID]);

        return $like !== null;
    }
}
