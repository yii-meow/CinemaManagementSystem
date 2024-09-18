<?php
namespace App\core;

class App
{


    private $controller = 'Homepage';//controller name                           //Can temporarily change to your currently working environment

    private $method = 'index';// method inside your controller                                  //Can temporarily change to your currently working environment

    private function splitURL()
    {

        $URL = $_GET['url'] ?? 'Homepage';// this must be same with the controller name in line 6                      //Can temporarily change to your currently working environment

        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }

    public function loadController()// this is dynamic routing function
    {
        $URL = $this->splitURL();

        $controllerName = ucfirst($URL[0]);
        $controllerClass = "\\App\\controllers\\" . $controllerName;

        if (class_exists($controllerClass)) {
            $this->controller = $controllerName;
            unset($URL[0]);
        } else {
            $controllerClass = "\\App\\controllers\\Error404";
            $this->controller = "Error404";                        //Dont change it plz
        }

        $controller = new $controllerClass();

        /** select method **/
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        call_user_func_array([$controller, $this->method], $URL);

    }

}


