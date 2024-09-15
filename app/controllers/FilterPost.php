<?php
namespace App\controllers;
use App\core\Controller;

class FilterPost
{
    use Controller;

    public function index()
    {
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the filter option from the form input
            $filterOption = filter_input(INPUT_POST, 'filterOptions', FILTER_SANITIZE_STRING);

            // Load the Post model
            $model = new Post();

            // Get filtered posts using the provided filter option
            $filteredPosts = $model->getFilteredPosts($filterOption);

            // Show the filtered results
            $data['searchResults'] = $filteredPosts ?: ['message' => 'No posts found.'];

            // Pass results to the view
            $this->view('Customer/Forum/SearchPostResult', $data);
        } else {
            // If no form is submitted, just show the page with the default filter
            $model = new Post();
            $data['searchResults'] = $model->getFilteredPosts('latestPost'); // Default filter
            $this->view('Customer/Forum/SearchPostResult', $data);
        }
    }
}
