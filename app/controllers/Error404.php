<?php


class Error404 extends Controller
{
    public function index()
    {
        $this->view('404Error', ['data' => null]);
    }
}
