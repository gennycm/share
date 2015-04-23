<?php

class UserFiles{
	private $view;
	private $usersList = array();
	private $action;
	private $postsList = Array();

	public function __construct($action){
		$this->view = new View($action);
		$this->action = $action;
	}

	public function showUserFiles(){
		$userFiles = $this->userFiles();
		return $this->view->getHTMLstuff().$this->view->getHeader(). $this->view->getSideBar($this->action).$this->view->getContainerStart().$userFiles.$this->view->getContainerStart().$this->view->getHTMLclosure();

	}

	public function uploadFileForm(){
		$uploadFileForm = "<form action='../PostController/savePost' method='post' onsubmit='return validateUpload()' enctype='multipart/form-data'>
				        <label>Comentario (120 caract)</label><br>
				        <textarea name='description' rows='2' cols='63' maxlength='120'></textarea><br><br>
		                <div class='col-md-6'>
			            	<input name='file' type='file'/>
			            </div>
		                <div class='col-md-6'>
				       		<input type='submit' class='largeButton portfolioBgColor' value='Guardar'>   
				       	</div>                    
				    </form>";
		return $uploadFileForm;
	}

	public function getUsersFiles(){
		$userFile = "";
		if (!empty($this->postsList)) {
            foreach($this->postsList as $postArray){
					$userFile = $userFile."<div class = 'row'>
							<div class='col-md-12'>
							    <div class='member-item'>
							        <div class='member-content'>
							            <h4>".$_SESSION["name"]."</h4>
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
	    return $userFile;
	}

	public function userFiles(){
	    $uploadFileForm = $this->uploadFileForm();

		$userFiles = "<div id='portfolio' class='section-content'>
					            <div class='row'>
					                <div class='col-md-12'>
					                    <div class='section-title'>
					                        <h2>
					                            Mis archivos
					                        </h2>
										</div>
										".$uploadFileForm."
									</div>
					            </div>
					            ".$this->getUsersFiles()."
					        </div>";
		return $userFiles;
	}


	public function setPostList($postsList){
		$this->postsList = $postsList;
	}

}
?>