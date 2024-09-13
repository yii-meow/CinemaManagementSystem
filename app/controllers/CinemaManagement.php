<?php

class CinemaManagement
{
    use Controller;

    public function index()
    {

        //Please do use this only at the end of the operations
        $this->view('Admin/Cinema/CinemaManagement');
    }
}