<?php
include_once(dirname(__FILE__)."/Config.php");

function __autoload($className) {

	if(file_exists('app\controller\\'.$className.'.php')){
		include_once 'app\controller\\'.$className.'.php';
	}

	if(file_exists('app\model\\'.$className.'.php')){
		include_once 'app\model\\'.$className.'.php';
	}

	if(file_exists('app\view\\'.$className.'.php')){
		include_once 'app\view\\'.$className.'.php';
	}


	if(file_exists('app\view\user\\'.$className.'.php')){
		include_once 'app\view\user\\'.$className.'.php';
	}

	if(file_exists('mvc\\'.$className.'.php')){
		include_once 'mvc\\'.$className.'.php';
	}

	if(file_exists('mvc\system\\'.$className.'.php')){
		include_once 'mvc\system\\'.$className.'.php';
	}

	if(file_exists('mvc\database\\'.$className.'.php')){
		include_once 'mvc\database\\'.$className.'.php';
	}


}

?>