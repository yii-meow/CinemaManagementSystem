<?php
namespace App\core;
trait Controller
{
    public function view($name, $data = []) // $name = destination path, $data = the retrieved data
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