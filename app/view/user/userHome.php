<?php

class UserHome{
	private $view;
	private $usersList = array();
	private $action;

	public function __construct($action){
		$this->view = new View($action);
		$this->action = $action;
	}

	public function showUserHome(){
		$userHome = "";
		return $this->view->getHTMLstuff().$this->view->getHeader(). $this->view->getSideBar($this->action).$userHome. $this->view->getFooter().$this->view->getHTMLclosure();

	}

}
?>