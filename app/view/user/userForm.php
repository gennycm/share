<?php

class UserForm{
	private $view;

	public function __construct($action){
		$this->view = new View($action);
	}

	function registerUser(){
		$registerUserForm = 
		"<div class='main'>".
			"<div class='login-form'>".
				"<h1>¡Regístrate!</h1>".
					"<form id='form_register' action='../PostController/savePost' method='POST'>".
						"<input type='hidden' value='null' name='id_user' id='id_user'  />".
				        "<input type='text' id='name' name='name' placeholder='Nombre completo'/><br>".
				        "<input type='text' id='email' name='email' placeholder='Correo'/><br>".
				        "<input type='text' id='username' name='username' placeholder='Nombre de usuario'  maxlength='13'/><br>".
				        "<input type='password' id='password' name='password' placeholder='Contraseña'/><br>".
				        "<input name='password_b' id='password_b'type='password' placeholder='Confirmar contraseña'>".
				        "<input type='submit' value='Registrarse'>".
				        "<p>¿Ya tienes cuenta?<a href='../UserController/login'> Inicia sesión</a></p>".
			        "</form>".
			"</div>".
		"</div>";

        return $this->view->getHTMLstuff().$this->view->getHeader(). $registerUserForm. $this->view->getFooter().$this->view->getHTMLclosure();
	}

	function userLogin(){
		$loginUserForm = "<div class='main'>".
		"<div class='login-form'>".
			"<h1>Inicio de sesión</h1>".
				"<form id='form_login' action='../UserController/loginUser' method='POST'>".
			        "<input type='text' id='username' name='username'  placeholder='Nombre de usuario'/><br>".
			        "<input type='password' id='password' name='password' placeholder='Contraseña'/><br>".
			        "<input type='submit' value='Entrar'>".
			        "<p>¿Aún no tienes cuenta?<a href='../UserController/register'> ¡Regístrate!</a></p>".
			        "</form>".
			"</div>".
		"</div>";

        return $this->view->getHTMLstuff().$this->view->getHeader(). $loginUserForm. $this->view->getFooter().$this->view->getHTMLclosure();
	}


	function formModifyUser($user){
		$userArray = Array();
		$userArray = $user->getAttributes();
		$modifyUserForm = "<form action='../UserController/modifyUser' method='POST'>".
	        "<input type='hidden' value='". $userArray["id_user"] ."' name='id_user' id='id_user'  />".
	        "<label>Name: </label><input type='text' id='firstName' name='firstName' value='". $userArray["firstName"] ."'/><br>".
	        "<label>Last name: </label><input type='text' id='lastName' name='lastName' value='". $userArray["lastName"] ."'/><br>".
	        "<label>Username: </label><input type='text' id='username' name='username' value='". $userArray["username"] ."'/><br>".
	        "<label>Password: </label><input type='password' id='password' name='password'/><br>".
	        "<input type='submit' value='Modify user'>".
        "</form>";

        return $this->view->getHTMLstuff().$this->view->getHeader(). $modifyUserForm. $this->view->getFooter().$this->view->getHTMLclosure();
	}


}


?>