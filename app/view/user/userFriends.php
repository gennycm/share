<?php
class UserFriends{
	private $view;
	private $usersList = array();
	private $action;

	public function __construct($action){
		$this->view = new View($action);
		$this->action = $action;
	}

	public function getUsersFriends($friendsList){
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

            return $userFriends;
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