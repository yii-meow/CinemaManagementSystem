<?php


class App
{
	private $controller = 'AddPost';//controller name                           //Can temporarily change to your currently working environment
	private $method 	= 'index';// method inside your controller                                  //Can temporarily change to your currently working environment

	private function splitURL()
	{
		$URL = $_GET['url'] ?? 'AddPost';// this must be same with the controller name in line 6                      //Can temporarily change to your currently working environment
		$URL = explode("/", trim($URL,"/"));
		return $URL;	
	}

	public function loadController()// this is dynamic routing function
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
			$this->controller = "Error404";// it will auto detect, when the page not exists it will direactly display 404                         //Dont change it plz
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


