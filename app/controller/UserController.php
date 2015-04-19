<?php
    include_once('/../../mvc/system/Controller.php');

class UserController extends Controller{
	private $action;
    private $params;

    public function __construct(){
        $params = array();
        $this->accessControl = array("register"=>array('admin','public'),
        "listUsers"=>array('admin'),
        "registerUser"=>array('admin','public'),
        "modify"=>array('admin'),
        "modifyUser"=>array('admin'),
        "deleteUser"=>array('admin'),
        "login"=>array('admin','public'),
        "loginUser"=>array('admin','public'),
        "inicio"=>array('admin'),
        "amigos"=>array('admin'));
        "perfil"=>array('admin'));
    }
    
    public function register(){
        $registerUserForm = new UserForm("register");
        echo $registerUserForm->registerUser();
    }

    public function registerUser(){
        $userData = $this->getParams();
        if(isset($userData) && !empty($userData))
        {
            $user = new User();
            unset($userData['password_b']);
            $user->setAttributes($userData);
            if($user!=null){
                $user->registerUser();
                //redirect
               header('Location: listUsers');
            }else{
                 $this->register();
            }
        }else{
            echo "You did not fill out the required fields :(";

        }
    }

    
       public function login(){
        $loginUserForm = new UserForm("login");
        echo $loginUserForm->userLogin();
    } 

    public function loginUser(){
        $userData = $this->getParams();
        if(isset($userData) && !empty($userData)){
            $appUser = new User();
            $systemUser = new SystemUser();
            $systemUser->login($userData,$appUser->getTableName());
            if ($systemUser->isLogged) {
                header("Location: inicio");            
            }else{
                $message = "El usuario o contraseña es incorrecta o no existe :c";
                echo "<script type='text/javascript'>
                            alert('$message');
                            window.location.href = 'login';
                      </script>";
            }
        }
    }

    public function inicio(){
        $userHome = new UserHome("Inicio");
        echo $userHome->showUserHome();
    }


    public function listUsers(){
        $user = new User();
        $usersList = $user->findAll();
        $listUsersView = new UserList("list");
        echo $listUsersView->showUsersList($usersList);
    }

    public function amigos(){
        $friends = new UserFriends("Amigos");
        echo $friends->getUsersFriends();


    }

    public function deleteUser(){
        $userData = $this->getParams();
        $user = new User();
        $user->setAttributes($userData);
        $user->delete();
        header('Location: listUsers');
    }

    public function modify(){
        $userData = $this->getParams();
        $user = new User();
        $user->setAttributes($userData);
        $modifyUserForm = new UserForm("modify");
        $user = $user->find();
        echo $modifyUserForm->formModifyUser($user);
    }

    public function modifyUser(){
        $userData = $this->getParams();
    	//($id_user, $firstName, $lastName, $username,$password)
        if(isset($userData) && !empty($userData))
	    {
            $user = new User();
            $user->setAttributes($userData);
            if($user!=null){
                $user->modifyUserInfo();
                //redirect
                //$this->listUsers();
                header('Location: listUsers');
            }else{
                 $this->register();
            }
        }else{
            echo "You did not fill out the required fields :(";

        }
    }
    
    public function perfil(){
        $userProfile = new UserProfile("Perfil");
        echo $userProfile->showProfile();
    }

    public function getParams() {
        return $this->params;
    }

    public function setParams($params) {
        $this->params = $params;
    }
}


?>