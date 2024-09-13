<?php

class CinemaManagement
{
    use Controller;

    public function index()
    {
        //Gather SQL parameters
        $movieID = 1; //test id

        // Initialize Model in order to use the model
        $model = new Cinema();
        $result = $model->getAllCinema();

        $data = [];
        if ($result) {
            $data['cinemas'] = $result;
        }

        //Please do use this only at the end of the operations
        $this->view('Admin/Cinema/CinemaManagement', $data);
    }
}