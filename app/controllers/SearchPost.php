<?php

class SearchPost
{
    use Controller;

    public function index()
    {
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the search query from the form input
            $searchTerm = filter_input(INPUT_POST, 'searchPost', FILTER_SANITIZE_STRING);

            // Load the Post model
            $model = new Post();

            // Search posts using the provided search term
            $searchResults = $model->searchPost($searchTerm);

            // Show the search results (You can pass this to the view)
            if ($searchResults) {
                $data['searchResults'] = $searchResults;
            } else {
                $data['message'] = 'No posts found for the search term.';
            }

            // Pass results to the view
            $this->view('Customer/Forum/SearchPostResult', $data);
        } else {
            // If no form is submitted, just show the search page
            $this->view('Customer/Forum/SearchPostResult');
        }
    }
}
