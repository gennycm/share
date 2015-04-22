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
		$userHome = $this->friendFiles();
		return $this->view->getHTMLstuff().$this->view->getHeader(). $this->view->getSideBar($this->action).$this->view->getContainerStart().$userHome.$this->view->getContainerStart().$this->view->getHTMLclosure();

	}

	public function friendFiles(){
		$userFriendsFiles = "<div id='about' class='section-content'>
					            <div class='row'>
					                <div class='col-md-12'>
					                    <div class='section-title'>
					                        <h2>
					                            Inicio
					                        </h2>
					                    </div>
									</div>
					          	</div>
					            ".$this->getFriendsFiles()."
					        </div>";

		return $userFriendsFiles;
	}

	public function setPostList($postsList){
		$this->postsList = $postsList;
	}

	public function getFriendsFiles(){
		$friendFile = "";
		if (!empty($this->postsList)) {
            foreach($this->postsList as $postArray){
					$friendFile = $friendFile."<div class = 'row'>
							<div class='col-md-12'>
							    <div class='member-item'>
							        <div class='member-content'>
							            <h4>".$postArray["name"]."</h4>
							            <p>".$postArray["description"]."</p>
							            <p><a href='../PostController/downloadPost?id_post=" . $postArray["id_post"] . "'>".$postArray["filepath"]."</a></p>
							        </div>
							    </div>
							</div>
				    </div>
				    <br/>
				    ";
            }
		}
	    return $friendFile;
	}
}
?>