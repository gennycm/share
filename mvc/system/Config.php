<?php
class Config{
	public $params = Array();
	private static $instance = null;
	
	function __construct() {
		$this->loadConfig();
	}
	
	static function getInstance(){
		if (!isset(self::$instance)) {
			self::$instance = new Config;
		}
		return self::$instance;
	} 
	
	function loadConfig(){
		$config = parse_ini_file("config.ini");
		$this->params = $config;
	}
	/**
	 * @return the $params
	 */
	public function getParams() {
		return $this->params;
	}

	public function setParams($params){
        $this->params = $params;
    }
	
}

?>