<?php
class Controller{
    protected $accessControl;
    private $params;
    
    public function addUserToAccessControl(){
        $user = $_SESSION["username"];
        $array = $_SESSION["accessControl"];
       
        foreach ($array as $key => $value) {
            if($key != "login" && $key != "loginUser" && $key != "register" && $key != "registerUser"){
                array_push($_SESSION["accessControl"][$key],$user);
            }
        }  
        echo "<br/>Usuarios con acceso: "; 
        print_r($_SESSION["accessControl"]);
    }
    
    public function runAction($action){
        if(array_key_exists($action,$this->accessControl)){
        $allowedUsers = $this->accessControl[$action];
        $app = WebApplication::getInstance();
            if(in_array(WebApplication::getInstance()->user->logged, $allowedUsers)){
                $this->$action();
            }else{
                echo "El usuario no tiene permiso de acceso a esta página :(";
            }
       }
    }
    
    public function redirect($url){
        header("Location: $url"); //
    }

    public function getParams() {
        return $this->params;
    }

    public function setParams($params) {
        $this->params = $params;
    }
}
?>
