<?php

class DetailSelection {
    use Controller;
    public function index() {
        //Get query string value
        $movieId = $_GET['mid'];

        //Model
        $model = new Movie();
        $arr["movieId"] = $movieId;  //Parameter for SQL Query => ["Column Name"]
        $result = $model->getMovieByMovieID($arr);

        //show($result);    //Test Result only

        $data = [];
        if($result){
            $data = [
                "movieId" => $result[0]->movieId,
                "title" => $result[0]->title,
                "duration" => $result[0]->duration,
                "photo" => $result[0]->photo,
            ];
        }

        //Please do use this only at the end of the operations
        $this->view('Customer/Selection/DetailSelection', $data);
    }
}
