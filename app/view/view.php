<?php
class View{
	private $header;
	private $action;
	private $footer;

	public function __construct($Action){
		$this->action = $Action;
		session_start();
	}

	function getHTMLstuff(){
		$htmlStuff="<!DOCTYPE html>
						<html>
						<head>
							<title> SYF | ".$this->action."</title>
							<meta charset='UTF-8'> 
							  <link rel='stylesheet' type='text/css' href='../app/css/bootstrap.min.css'>
							  <link rel='stylesheet' type='text/css' href='../app/css/font-awesome.min.css'>
							  <link rel='stylesheet' type='text/css' href='../app/css/templatemo_misc.css'>
							  <link rel='stylesheet' type='text/css' href='../app/css/templatemo_style.css'>
							  <link rel='stylesheet' type='text/css' href='app/css/styles.css' />
							  <meta name='viewport' content='width=device-width, initial-scale=1'>
							  <link rel='stylesheet' type='text/css' href='../app/css/styles.css' />
							  <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
						</head>
						<body>";
		return $htmlStuff;
	}

	function getHeader(){
		$this->header = "<header><h2></h2></header>";
		return $this->header;
	}

	function getFooter(){
		$this->footer= "</div><footer>SHARE YOUR FILES ♥ </footer>";
		return $this->footer;
	}

	function getHTMLclosure(){
		return "</body>
				</html>";
	}


	function getSideBar($action){
		$listElements = "";

		switch ($action) {
		    case "Inicio":
				$listElements = "<li class='home'><a class='active' href='#'>Inicio</a></li>
					            <li class='portfolio'><a href='#'>Mis Archivos</a></li>
					            <li class='contact'><a href='../UserController/listFriends'>Amigos</a></li>
	            	            <li class='about'><a href='#about'>Cerrar sesión</a></li>";
		        break;
		    case "Mis archivos":
				$listElements = "<li class='home'><a href='#'>Inicio</a></li>
					            <li class='portfolio'><a class='active' href='#'>Mis Archivos</a></li>
					            <li class='contact'><a href='#'>Amigos</a></li>
	            	            <li class='about'><a href='#about'>Cerrar sesión</a></li>";
		        break;
		    case "Amigos":
				$listElements = "<li class='home'><a href='#'>Inicio</a></li>
					            <li class='portfolio'><a href='#'>Mis Archivos</a></li>
					            <li class='contact'><a class='active' href='#'>Amigos</a></li>
	            	            <li class='about'><a href='#about'>Cerrar sesión</a></li>";
		        break;
		    case "Cerrar sesión":
				$listElements = "<li class='home'><a href='#'>Inicio</a></li>
					            <li class='portfolio'><a href='#'>Mis Archivos</a></li>
					            <li class='contact'><a href='#'>Amigos</a></li>
	            	            <li class='about'><a class='active' href='#about'>Cerrar sesión</a></li>";
		        break;
		    default:
				$listElements = "<li class='home'><a href='#'>Inicio</a></li>
					            <li class='portfolio'><a href='#'>Mis Archivos</a></li>
					            <li class='contact'><a href='#'>Amigos</a></li>
	            	            <li class='about'><a href='#about'>Cerrar sesión</a></li>";
		}

		$userHome = "<div id='main-sidebar' class='hidden-xs hidden-sm'>
		<div class='logo'>
			<a href='#'><h1>".$_SESSION["username"]."</h1></a>
			<span>".$_SESSION["name"]."</span>
		</div> 
		<div class='navigation'>
	        <ul class='main-menu'>
	            ".$listElements."
	        </ul>
		</div> <!-- /.navigation -->";
		return $userHome;
	}



	function getContainerStart(){
		return "<div id='main-content'>
    			<div class='container-fluid'>";
	}

	function getContainerEnd(){
		return "</div>
			</div>";

	}

}
?>