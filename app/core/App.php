<?php
namespace App\core;

class App
{
	private $controller = 'Homepage';                           //Can temporarily change to your currently working environment
	private $method 	= 'index';                                  //Can temporarily change to your currently working environment

	private function splitURL()
	{
		$URL = $_GET['url'] ?? 'Homepage';                      //Can temporarily change to your currently working environment
		$URL = explode("/", trim($URL,"/"));
		return $URL;	
	}

	public function loadController()
	{
		$URL = $this->splitURL();

        $controllerName = ucfirst($URL[0]);
        $controllerClass = "\\App\\controllers\\" . $controllerName;

        if(class_exists($controllerClass))
        {
            $this->controller = $controllerName;
            unset($URL[0]);
        }else{
            $controllerClass = "\\App\\controllers\\Error404";
            $this->controller = "Error404";                        //Dont change it plz
		}

        $controller = new $controllerClass();

		/** select method **/
		if(!empty($URL[1]))
		{
			if(method_exists($controller, $URL[1]))
			{
				$this->method = $URL[1];
				unset($URL[1]);
			}	
		}

		call_user_func_array([$controller,$this->method], $URL);

	}	

}


