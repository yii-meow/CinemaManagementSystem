<?php

class DetailSelection
{
    use Controller;


    //Main Method
    public function index()
    {
        //Get query string value
        $movieId = $_GET['mid'];
        $_SESSION['movieId'] = $movieId;

        //Get Movie Details
        $model = new Movie();
        $arr["movieId"] = $movieId;  //Parameter for SQL Query => ["Column Name"]
        $result = $model->getMovieByMovieID($arr);

        $dataMovieDetails = [];
        if ($result) {
            $dataMovieDetails = [
                "movieId" => $result[0]->movieId,
                "title" => $result[0]->title,
                "duration" => $result[0]->duration,
                "photo" => $result[0]->photo,
            ];
        }



        //Get Movie Schedule Date and Time
        $dataSchedule = [];

        $modelSchedule = new MovieSchedule();
        $arrSchedule["movieId"] = $movieId;
        $resultSchedule = $modelSchedule->getMovieScheduleDate($arrSchedule);

        if ($resultSchedule) {
            foreach ($resultSchedule as $schedule) {
                $dataSchedule[] = $schedule;
            }
        }

        // Combines multiple $data from different queries
        $data = [
            'movies' => $dataMovieDetails,
            'schedules' => $dataSchedule,
        ];

        //Please do use this only at the end of the operations
        $this->view('Customer/Selection/DetailSelection', $data);
    }



    //Method 2
    public function fetchHallExperienceOfTheMovieDate()
    {
        $dataHall = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from POST request
            $selectedDate = $_POST['selectedDate'] ?? '';

            $modelHall = new CinemaHall();
            $arr = [
                "movieId" => $_SESSION['movieId'],
                "startingTime" => $selectedDate
            ];
            $result = $modelHall->getCinemaHallOfMovie($arr);

            if ($result) {
                // Respond with JSON
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                exit;
            }
        }
        // Handle other methods or render a view
        $this->view('Customer/Selection/SeatSelection', $dataHall);
    }

}
