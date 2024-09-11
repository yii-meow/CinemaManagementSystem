<?php


class App
{
	private $controller = 'MovieDetails';                           //Can temporarily change to your currently working environment
	private $method 	= 'index';                                  //Can temporarily change to your currently working environment

	private function splitURL()
	{
		$URL = $_GET['url'] ?? 'MovieDetails';                      //Can temporarily change to your currently working environment
		$URL = explode("/", trim($URL,"/"));
		return $URL;	
	}

	public function loadController()
	{
		$URL = $this->splitURL();

		/** select controller **/
		$filename = "../app/controllers/".ucfirst($URL[0]).".php";
		if(file_exists($filename))
		{
			require $filename;
			$this->controller = ucfirst($URL[0]);
			unset($URL[0]);
		}else{
			$filename = "../app/controllers/Error404.php";          //Dont change it plz
			require $filename;
			$this->controller = "Error404";                         //Dont change it plz
		}

		$controller = new $this->controller;

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


