<?php

require_once '../core/Controller.php';
class Home extends Controller {

    // Index of the home page (localhost/home(/index))
    public function index($param1= '', $param2= '', $param3= '') {
        
        // Initialize the Model
        $test = $this->model('Test');

        // Call function from the Model, and get the returned results (In the case, the $testData contains the returned results)
        // Inside the method (), we can pass in the parameters for SQL query, according to the '?' sequence in the method in the Model
        $testData = $test->getTestFunction();

        // Purpose: Specify the respective view file, and pass the returned results ($testData) as parameters, intended to pass to the view file
        // param... is the values that can be passed to the index() method of the Controller
        $this->view('home/index', ['test' => $testData, 'parameters' => [$param1, $param2, $param3]]);
    }
}


?>