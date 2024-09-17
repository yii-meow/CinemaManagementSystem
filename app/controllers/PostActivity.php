<?php

/*class PostActivity {
    public function viewActivity() {
        //$userId = $_SESSION['userId']; // Get the current logged-in user ID
        $userId = 1; // For testing purposes, use a hardcoded user ID
        $postActivityService = new PostActivityService();
        $xmlData = $postActivityService->getPostActivityAsXML($userId);

        // Load the XML and XSLT
        $xml = new DOMDocument;
        $xml->loadXML($xmlData);

        $xsl = new DOMDocument;
        $xslPath = '../views/Customer/Forum/PostActivity.xsl';
        if (!file_exists($xslPath)) {
            die('XSL file not found: ' . $xslPath);
        }
        $xsl->load($xslPath);

        // Apply the XSLT transformation
        $proc = new XSLTProcessor;
        $proc->importStyleSheet($xsl);
        echo $proc->transformToXML($xml);
    }
}*/
?>
