<?php

class DetailSelection
{
    use Controller;

    public function index()
    {
        //Get query string value
        $movieId = $_GET['mid'];

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
        $hallIDs = [];
        $dataSchedule = [];

        $modelSchedule = new MovieSchedule();
        $arrSchedule["movieId"] = $movieId;
        $resultSchedule = $modelSchedule->getMovieScheduleDate($arrSchedule);

        if ($resultSchedule) {
            foreach($resultSchedule as $schedule) {
                $dataSchedule[] = $schedule;

                $hallIDs[] = $schedule->cinemaHallId;
            }
        }

        //Get Cinema Hall of the Movie
        $dataHall = [];

        $modelHall = new CinemaHall();
        foreach ($hallIDs as $id) {
            $arrHall["hallId"] = $id;
            $resultHall = $modelHall->getCinemaHallOfMovie($arrHall);

            if ($resultHall) {
                foreach ($resultHall as $hall) {
                    $dataHall[] = $hall;
                }
            }
        }



        // Combines multiple $data from different queries
        $data = [
            'movies' => $dataMovieDetails,
            'schedules' => $dataSchedule,
            'halls' => $dataHall,
        ];
        show($data);


        //Please do use this only at the end of the operations
        $this->view('Customer/Selection/DetailSelection', $data);
    }


}
