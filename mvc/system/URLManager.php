<?php
class URLManager{
	public $url;
	public $controller;
	public $action;
	public $params = Array();
	
	function processURL($request){
		if(count($request)>0){
			$url = $request['url'];
			$urlArray = $this->parseUrl($url);
			$this->controller = $urlArray[0];
			$this->action = $urlArray[1];
			unset($request["url"]);
			$this->params = $request;

			if (isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"])) {
				$this->params["filename"] = $_FILES["file"]["name"];
				$this->params["filename_tmp"] = $_FILES["file"]["tmp_name"];
			}
		}else{
			//echo 'Error al procesar la URL :c';
		}
	}
	
	function parseUrl($url){
		$url = preg_replace('/\/$/', '', $url);
		$this->url = $url;

		$urlArray = explode('/', $url);
		$size = count($urlArray);
		
		for($i = 0; $i < $size; $i++){
			$urlArray[$i] = $this->clean($urlArray[$i]);
		}

		return $urlArray;

	}

	private function clean($valor){
		return preg_replace('/[^a-zA-Z0-9-_.@ ]/', '', $valor);
	}
	
	function getRequest(){
		return $_REQUEST;
	}
	
	function getController(){
		return $this->controller;
	}
	
	function getAction(){
		return $this->action;
	}
	
	function getParams(){
		return $this->params;
	}
}
?>