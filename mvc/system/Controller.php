<?php
class Controller{
    protected $accessControl;
    
    public function runAction($action){
        if(array_key_exists($action,$this->accessControl)){
        $allowedUsers = $this->accessControl[$action];
        $app = WebApplication::getInstance();
            if(in_array( WebApplication::getInstance()->user->logged, $allowedUsers)){
                $this->$action();
            }else{
                echo "El usuario no tiene permiso de acceso a esta página :(";
            }
       }
    }
    
    public function redirect($url){
        header("Location: '".$url."'"); //
    }
}
?>
