<?php

class Router{

	protected static $controller = 'index';

	protected static $action = 'index';

	protected static $params = [];

	public function __construct(){
		
		$url = $this->parseUrl();

		if($url[0] != ''){
			self::$controller = $url[0];
			unset($url[0]);
		}

		if(isset($url[1])){
			self::$action = $url[1];
			unset($url[1]);
		}
		$paramsArr = $url ? array_values($url) : [] ;

		self::$params = [];

		for($i = 0; $i < count($paramsArr); $i += 2){
			$tmpValue = '';
			if(array_key_exists($i+1,$paramsArr)){
				$tmpValue = $paramsArr[$i+1];
			}
			self::$params[$paramsArr[$i]] = $tmpValue; 
		}

	}

	public function run(){
		$controllerClassName = ucfirst(self::$controller) . 'Controller';

		require_once ROOT.'/controllers/' . $controllerClassName . '.php';
		
		$controllerClass = new $controllerClassName;
		// var_dump($controllerClass); exit();

		$method = self::$action;
		$controllerClass->$method();
	}


	public function parseUrl(){
		return $url = explode('/', filter_var(rtrim(isset($_GET['url'])?$_GET['url']:'', '/'), FILTER_SANITIZE_URL));
	}
	
	public static function getController(){
		return self::$controller;
	}
	
	public static function getAction(){
		return self::$action;
	}
	
	public static function getParams(){
		return self::$params;
	}
	
	public static function getParam($key){
		if (array_key_exists($key, self::$params)) {
			return self::$params[$key];
		}
        return null;
	}
}

