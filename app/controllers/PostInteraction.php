<?php
namespace App\controllers;
use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\Likes;
use App\models\User;
use App\Observers\LikeObserver;
use App\Observers\UnlikeObserver;
use App\Observers\Like;

class PostInteraction
{
    use Controller;

    private $entityManager;
    private $postRepository;
    private $likeRepository;
    private $userRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->likeRepository = $this->entityManager->getRepository(Likes::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function like()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_NUMBER_INT);
            $postID = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT);

            $post = $this->postRepository->find($postID);
            $user = $this->userRepository->find($userID);

            show("USERID : " . $userID);

            if ($post && $user) {
                // Create the Like subject (concrete subject)
                $likeSubject = new Like();
                $likeSubject->setLike($post, $user, new \DateTime());

                // Check if the user already liked the post
                $existingLike = $this->likeRepository->findOneBy(['post' => $post, 'likedBy' => $user]);

                if ($existingLike) {
                    // Unlike the post
                    $post->getLikes()->removeElement($existingLike);

                    // Attach UnlikeObserver
                    $unlikeObserver = new UnlikeObserver($likeSubject);
                    $likeSubject->attach($unlikeObserver);

                    // Notify observers
                    $likeSubject->notifyAllObservers();

                    // Remove the like from the database
                    $this->entityManager->remove($existingLike);
                    $this->entityManager->flush();

                    $isLiked = false; // User has unliked the post
                } else {
                    // Like the post
                    $newLike = new Likes();
                    $newLike->setPost($post)
                        ->setLikedBy($user)
                        ->setLikeDate(new \DateTime());

                    $post->getLikes()->add($newLike);

                    // Attach LikeObserver
                    $likeObserver = new LikeObserver($likeSubject);
                    $likeSubject->attach($likeObserver);

                    // Notify observers
                    $likeSubject->notifyAllObservers();

                    // Persist the new like in the database
                    $this->entityManager->persist($newLike);
                    $this->entityManager->flush();

                    $isLiked = true; // User has liked the post
                }

                /*need to think of it first*/
                if($isLiked) {
                    $_SESSION['likeStatus'] = 0;
                }else{
                    $_SESSION['likeStatus'] = 1;
                }


                // Pass updated like status and all posts to the view
                /*$this->view('Customer/Forum/Forum', [
                    //'likeCount' => $likeCount,
                    'isLiked' => $isLiked
                   // 'posts' => $posts // Pass all posts here
                ]);*/
                redirect('Forum/index');
            }
        }
    }
}
?>
