<?php

class UserController extends Controller{
    private $action;

    public function __construct(){
        $params = array();
        $this->accessControl = array(
        "login"=>array('admin','public'),
        "loginUser"=>array('admin','public'),
        "register"=>array('admin','public'),
        "registerUser"=>array('admin','public'),    
        "listUsers"=>array('admin'),
        "modify"=>array('admin'),
        "modifyUser"=>array('admin'),
        "deleteUser"=>array('admin'),
        "inicio"=>array('admin'),
        "amigos"=>array('admin'),
        "perfil"=>array('admin'),
        "editarPerfil"=>array('admin'),
        "saveProfile"=>array('admin'),
        "buscarAmigos"=>array('admin'),
        "deleteFriend"=>array('admin'),
        "addFriend"=>array('admin'),
        "misArchivos"=>array('admin'),
        "cerrarSesion"=>array('admin'));
        
        session_start();
        //$_SESSION["accessControl"][]=$this->accessControl;
    }
    
    public function register(){
        session_destroy();
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
               header('Location: login');
            }else{
                 $this->register();
            }
        }else{
            echo "You did not fill out the required fields :(";

        }
    }
    
    public function login(){
     //   session_start();
        session_destroy();
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
                //$this->addUserToAccessControl();
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
        $postList = new PostController();
        $postArray = $postList->listUserFriendsPosts();
        $userHome->setPostList($postArray);


        echo $userHome->showUserHome();
    }

    public function misArchivos(){
        $userFiles = new UserFiles("Mis archivos");
        $postList = new PostController();
        $postArray = $postList->listPostsByUser();
        $userFiles->setPostList($postArray);
        echo $userFiles->showUserFiles();
    }

    public function listUsers(){
        $user = new User();
        $usersList = $user->findAll();
        $listUsersView = new UserList("list");
        echo $listUsersView->showUsersList($usersList);
    }

    public function amigos(){
        $friends = new UserFriends("Amigos");
        $user = new User();
        $friendsList = $user->getUsersFriends();
        $pFriendsList = $user->getPosibleFriends();
        echo $friends->getFriendsContent($friendsList, $pFriendsList);
    }

    public function buscarAmigos(){
        $friends = new UserFriends("Amigos");
        $user = new User();
        $friendsList = $user->getUsersFriends();
        if (!empty($this->getParams()["search_string"])) {
            $resultFriendsList = $user->searchFriend($this->getParams()["search_string"]);
            echo $friends->getFriendsContent($friendsList, $resultFriendsList);
        }else{
            $this->amigos();
        }
    }


    public function deleteFriend(){
        $userData = $this->getParams();
        $user = new User(); 
        $result = $user->deleteFriend($this->getParams()["idFriend"]);   
        header('Location: amigos');
    }

    public function addFriend(){
        $userData = $this->getParams();
        $user = new User(); 
        $result = $user->addFriend($this->getParams()["idFriend"]);   
        header('Location: amigos');        
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
    
    public function editarPerfil(){
        $userProfile = new UserProfile("Perfil");
        echo $userProfile->editUserProfile();
    }
    
    public function saveProfile(){
        $userData = $this->getParams();
        $user = new User();
        $user->setAttributes($userData);
        $user->modifyUserInfo();
        
        $systemUser = new SystemUser();
        $systemUser->setVariables($userData);
        
        $message = "Los datos del usuario han sido cambiados exitosamente";
        echo "<script type='text/javascript'>
            alert('$message');
            window.location.href = 'perfil';
            </script>";
    }
    
    public function cerrarSesion(){
        $systemUser = new SystemUser();
        $systemUser->logout();
        header('Location: login');
        exit();
    }
}
?>