<?php
	include_once(dirname(__FILE__)."/mvc/system/WebApplication.php");

	$webApp = WebApplication::getInstance();
	$webApp->start();
?>