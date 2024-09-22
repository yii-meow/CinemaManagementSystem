<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\ReportRequest;
use App\repositories\PostRepository;
use App\repositories\ReportRepository;
use Doctrine\ORM\EntityManager;

class AdminForum
{
    use Controller;

    private EntityManager $entityManager;
    private PostRepository $postRepository;
    private ReportRepository $reportRepository;


    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->reportRepository = $this->entityManager->getRepository(ReportRequest::class);

    }

    public function index()
    {
        $posts = $this->postRepository->findAll();

        $postData = [];
        foreach ($posts as $post) {
            $reportReason = '';

                // Get the report requests for the post
                $reportRequests = $post->getReportPost();

            if (!$reportRequests->isEmpty()) {
                // Fetch the first report
                $firstReport = $reportRequests->first();

                // Get the reason from the first report
                $reportReason = $firstReport->getReason();
            }

            // get post data
            $postData[] = [
                'postID' => $post->getPostID(),
                'userName' => $post->getUser()->getUsername(),
                'content' => $post->getContent(),
                'contentImg' => $post->getContentImg(),
                'status' => $post->getStatus(),
                'reportReason' => $reportReason
            ];
        }
        $this->view('Admin/Forum/ForumManagement', ['posts' => $postData]);
    }

}
