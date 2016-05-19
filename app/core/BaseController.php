<?php

abstract class BaseController{

	private $data = array();

	public function __get($name) {
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
        return null;
    }

    public function __set($name, $value) {
        return $this->data[$name] = $value;
    }

	public function render($action = '', $controller = ''){

		if($controller == ''){
			$controller = Router::getController();
		}
		
		if($action == ''){
			$action = Router::getAction();
		}
	
		require_once ROOT.'/views/' . $controller . '/' . $action . '.php';

	}
}