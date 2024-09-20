<?php

namespace App\controllers;

use App\Core\Controller;
use App\Core\Database;
use App\models\Likes;
use App\Models\Post;
use App\models\User;
use App\Repositories\PostRepository;

class FilterForum
{
    use Controller;

    private $entityManager;
    private PostRepository $postRepository;
    private $userRepository;


    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
        $this->sessionManager->sessionTimeout();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filterOption = filter_input(INPUT_POST, 'filterOptions', FILTER_SANITIZE_SPECIAL_CHARS);

            $userId = $_SESSION['userId'];
            $user = $this->userRepository->find($userId);


            // Get filtered posts
            $posts = $this->filterPostsByOption($filterOption);

            // get content
            $postData = [];
            foreach ($posts as $post) {
                $isLiked = $this->isPostLikedByUser($post, $user);
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

            $viewName = 'Customer/Forum/Forum';

            $this->view($viewName, ['posts' => $postData,  'user' => $user, 'filter' => $filterOption]);
        }
    }

    private function filterPostsByOption($filterOption)
    {
        switch ($filterOption) {
            case 'latestPost':
                return $this->postRepository->filterPostsOrderedByDate('DESC');

            case 'oldestPost':
                return $this->postRepository->filterPostsOrderedByDate('ASC');

            case 'highestLikes':
                return $this->postRepository->filterPostsOrderedByLikes('DESC');

            case 'lowestLikes':
                return $this->postRepository->filterPostsOrderedByLikes('ASC');

            default:
                return $this->postRepository->filterPostsByIds([]);
        }
    }
    private function isPostLikedByUser(Post $post, User $user): bool
    {
        $likeRepository = $this->entityManager->getRepository(Likes::class);
        $like = $likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);

        return $like !== null;
    }
}
