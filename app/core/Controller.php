<?php
//Dont change it plz
trait Controller
{
    public function view($name, $data = [])
    {
        if (!empty($data))
            extract($data);

        $filename = "../app/views/" . $name . ".view.php";
        //$filename = "../app/views/" . $name . ".php";

        if (file_exists($filename)) {
            require $filename;
        } else {

            $filename = "../app/views/404Error.view.php";
            //$filename = "../app/views/404Error.view.php";

            require $filename;
        }
    }
}