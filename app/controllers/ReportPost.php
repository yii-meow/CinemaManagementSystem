<?php
namespace App\controllers;
/**
 * @author Angeline Chuang May Teng
 */
use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\ReportRequest;
use Doctrine\ORM\EntityManager;

class ReportPost
{
    use Controller;

    private EntityManager $entityManager;
    private $postRepository;
    private $reportRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->reportRepository = $this->entityManager->getRepository(ReportRequest::class);

    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reportReason = filter_input(INPUT_POST, 'reportReason', FILTER_SANITIZE_STRING);
            $postID = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT);

            if ($reportReason && $postID) {
                            // Find the post to report
                            $post = $this->postRepository->find($postID);

                            if ($post) {
                                // Create a new ReportRequest
                                $reportRequest = new ReportRequest();
                                $reportRequest->setPost($post)
                                    ->setReportDate(new \DateTime())
                                    ->setReportStatus('Pending')
                                    ->setReason($reportReason);

                                // Update post status to 'Reported'
                                $post->setStatus('Reported');

                                try {

                                    // store the report request
                                    $this->entityManager->persist($reportRequest);
                                    $this->entityManager->flush();

                                   header('Location: ' . ROOT . '/Forum?message=success');
                                    exit;
                                } catch (\Exception $e) {
                                    error_log($e->getMessage());
                                    header('Location: ' . ROOT . '/Forum?message=error');
                                    exit;
                                }
                            } else {
                                echo 'Error: Post not found.';
                            }
                        } else {
                            //  form validation errors
                            echo 'Error: No reason provided.';
                        }
                    } else {
                        //  invalid request method
                        echo 'Error: Invalid request method.';
                    }
        }

}
