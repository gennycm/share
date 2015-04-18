<?php

class UserView{
	private $view;

	public function __construct(){
		$this->view = new View();
	}

	function showUserData($user){
		$userData = "<div style='text-align: center;'>".
            			"Nombre: ".$user->getFirstName()."<br>".
			            "Apellido: ".$user->getLastName()."<br>".
			            "Usuario: ".$user->getUser()."<br>".
			            "</div>";

        return $this->view->getHTMLstuff().$this->view->getHeader(). $userData. $this->view->getFooter().$this->view->getHTMLclosure();
	}

	
}
?>