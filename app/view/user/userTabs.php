<?php

class UserTabs{
	private $view;
	private $usersList = array();
	private $action;

	public function __construct($action){
		$this->view = new View($action);
		$this->action = $action;
	}

	public function showUserHome($user){
		$userHome = "";
		return $this->view->getHTMLstuff().$this->view->getHeader(). $this->view->getSideBar($user, $this->action).$userHome. $this->view->getFooter().$this->view->getHTMLclosure();

	}

}
?>