<?php
function __autoload($className) {

	$classNameArr = explode('_', $className);
	$className = implode('/', $classNameArr);

    $classPath = ROOT . '/extensions/'. $className .'.php';
    require_once($classPath);
}
?>