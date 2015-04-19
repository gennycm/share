<?php
	include_once(dirname(__FILE__)."/Autoloader.php");

class WebApplication{
    public $urlMgr;
    public $user;
    public $dbCon;
    public static $instance;
	    
    public function __construct(){
        $this->user = new SystemUser();
        $this->user->logged = "admin";
        $this->user->isLogged = true;
    }

    public static function getInstance(){
        if (!isset(self::$instance)) {
                self::$instance = new WebApplication;
        }
        return self::$instance;
    } 

    public function start(){
        $this->urlMgr = new URLManager();
        $this->urlMgr->processURL($_REQUEST); //$_GET
        $this->dbCon = new DBConnection();
        $this->dbCon->connect();

        if($this->urlMgr->getController() != '' && $this->urlMgr->getAction() != ''){
                $selectedCtrl = $this->urlMgr->getController();
                $action = $this->urlMgr->getAction();
                $controller = new $selectedCtrl();
                $controller->setParams($this->urlMgr->getParams());
                $controller->runAction($action);   

	 	}else{
		 	if($this->urlMgr->getController() != '' && $this->urlMgr->getAction() == ''){
	 			header('Location: UserController/login');
		 	}else{
	 			header('Location: UserController/login');
		 	}


	 	}
    }         
}
?>