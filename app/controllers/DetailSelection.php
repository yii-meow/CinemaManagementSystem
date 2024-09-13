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

        show($data);

        //show($data);

        //Please do use this only at the end of the operations
        $this->view('Customer/Selection/DetailSelection', $data);
    }



    //If the system cannot find the specified method in view, it will call the default one which is index() specified in App.php
    //Method 2
    public function fetchHallExperienceOfTheMovieDate()
    {
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
    }

    public function fetchCinemaAndTime(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from POST request
            $SelectedValues = $_POST['options-exp'] ?? '';
            $explodedValue = explode("|", $SelectedValues);
            $selectedExperience = $explodedValue[0];
            $selectedDate = $explodedValue[1];

            $modelCinema = new Cinema();
            $arr = [
                "hallType" => $selectedExperience,
                "startingTime" => $selectedDate,
                "movieId" => $_SESSION['movieId'],
            ];
            $result = $modelCinema->getCinemaHallOfMovie($arr);

            if ($result) {
                // Respond with JSON
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                exit;
            }
        }
    }

}
