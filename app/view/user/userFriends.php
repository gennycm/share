<?php
class UserFriends{
	private $view;
	private $usersList = array();
	private $action;

	public function __construct($action){
		$this->view = new View($action);
		$this->action = $action;
	}

	public function getUsersFriends(){
		$userFriends = "<div id='about' class='section-content'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='section-title'>
                        <h2>
                            Mis amigos
                        </h2>
                    </div>
                </div>
            </div>";

            return  $this->view->getHTMLstuff().$this->view->getHeader().$this->view->getSideBar($this->action).$this->view->getContainerStart().$userFriends.$this->view->getContainerEnd().$this->view->getFooter().$this->view->getHTMLclosure();;
	}

	public function getPosibleFriends($friendsList){
		$userPosibleFriends = "<div id='about' class='section-content'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='section-title'>
                        <h2>
                            Buscar amigos
                        </h2>
                    </div>
                </div>
            </div>";

            return $userPosibleFriends;
	}


}
?>