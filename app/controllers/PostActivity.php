<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Post;
use App\models\User;
use App\models\Likes;
use App\models\Comment;
use App\models\Reply;

class PostActivity {
    use Controller;

    private $entityManager;
    private $postRepository;
    private $userRepository;
    private $commentRepository;
    private $replyRepository;
    private $likesRepository;

    public function __construct() {
        $this->entityManager = Database::getEntityManager();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
        $this->likesRepository = $this->entityManager->getRepository(Likes::class);
        $this->replyRepository = $this->entityManager->getRepository(Reply::class);
        $this->sessionManager = new SessionManagement();

        // Call session timeout check at the start of every request
        $this->sessionManager->sessionTimeout();
    }

    public function index() {
        $userID = $_SESSION['userId'] ?? null;

        if (!$userID) {
            // Redirect back
            header("Location: /MyForum/index");
            exit;
        }

        $this->generateXML($userID);

        $xmlPath = 'C:/xampp/htdocs/CinemaManagementSystem/app/xml/postData';
        $xslPath = 'C:/xampp/htdocs/CinemaManagementSystem/app/xml/postActivity';

        if (!file_exists($xmlPath)) {
            die("Error: XML file not found at $xmlPath");
        }
        if (!file_exists($xslPath)) {
            die("Error: XSL file not found at $xslPath");
        }

        // Load XML
        $xml = new \DOMDocument;
        $xml->load($xmlPath);

        // Load XSL
        $xsl = new \DOMDocument;
        $xsl->load($xslPath);

        // Create XSLTProcessor
        $proc = new \XSLTProcessor;
        $proc->importStylesheet($xsl);

        // Set the parameter for XSLT
        $proc->setParameter('', 'userId', $userID); // Filter XML based on the specific user

        // Transform XML
        $html = $proc->transformToXML($xml);

        // Output the result
        echo $html; // Display the transformed XML
    }

   private function generateXML($userID) {
    // Retrieve the user's posts data
    $posts = $this->postRepository->findBy(['user' => $userID]);

    // Generate XML document
    $xml = new \DOMDocument('1.0', 'UTF-8');
    $xml->formatOutput = true;

    // Create the root element
    $root = $xml->createElement('PostActivity');
    $xml->appendChild($root);

    // Fetch and add each post to the XML
    foreach ($posts as $post) {
        $postElement = $xml->createElement('Post');

        // Add post details
        $postElements = [
            'postID' => $post->getPostID(),
            'content' => $post->getContent(),
            'postDate' => $post->getPostDate()->format('Y-m-d H:i:s'),
        ];

        foreach ($postElements as $key => $value) {
            $element = $xml->createElement($key, htmlspecialchars($value));
            $postElement->appendChild($element);
        }

        // Add comments
        foreach ($post->getComments() as $comment) {
            $commentElement = $xml->createElement('Comment');

            $commentElements = [
                'commentID' => $comment->getCommentID(),
                'commentText' => $comment->getCommentText(),
            ];

            foreach ($commentElements as $key => $value) {
                $element = $xml->createElement($key, htmlspecialchars($value));
                $commentElement->appendChild($element);
            }

            // Add replies to the comment
            foreach ($comment->getReplies() as $reply) {
                $replyElement = $xml->createElement('Reply');

                $replyElements = [
                    'replyID' => $reply->getReplyID(),
                    'replyText' => $reply->getReplyText(),
                ];

                foreach ($replyElements as $key => $value) {
                    $element = $xml->createElement($key, htmlspecialchars($value));
                    $replyElement->appendChild($element);
                }

                $commentElement->appendChild($replyElement);
            }

            $postElement->appendChild($commentElement);
        }

        // Add likes
        foreach ($post->getLikes() as $like) {
            $likeElement = $xml->createElement('Like');

            $likeElements = [
                'likeID' => $like->getLikeID(),
                'likeDate' => $like->getLikeDate()->format('Y-m-d H:i:s'),
            ];

            foreach ($likeElements as $key => $value) {
                $element = $xml->createElement($key, htmlspecialchars($value));
                $likeElement->appendChild($element);
            }

            $postElement->appendChild($likeElement);
        }

        $root->appendChild($postElement);
    }
        // Save XML to file
        $xml->save('C:/xampp/htdocs/CinemaManagementSystem/app/xml/postData');
    }

}
?>
