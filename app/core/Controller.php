<?php
//Dont change it plz
namespace App\core;
trait Controller
{
    public function view($name, $data = [])
    {
        if (!empty($data))
            extract($data);

        $filename = "../app/views/" . $name . ".view.php";

        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/404Error.view.php";
            require $filename;
        }
    }
}