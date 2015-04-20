<?php
class SystemUser{
    public $isLogged;
    private $userObj;
    public $logged;
    
    public function login($userData, $tbName){
       if($this->authenticate($userData, $tbName)){
        // session_start();
          $userInfo = $this->userObj->getAttributes();
          $this->setSessionVariables($userInfo);
          $this->logged= $_SESSION["username"];
          $this->isLogged = true;
       }else{
          $this->isLogged = false;
       }
    }
    
    public function logout(){
        session_start();
        session_destroy();
        $this->isLogged = false;
    }
    
    public function authenticate($userData, $tbName){
        $result = DBConnection::getInstance()->getDBCommand()->select($userData, $tbName);
        $userInfo = Array();
        foreach ($result as $auxArray) {
            foreach ($auxArray as $key => $value) {
                if(!is_numeric($key)) {
                $userInfo[$key] = $value;
                }
            }
        }
        $this->userObj = new User();
        $this->userObj->setAttributes($userInfo);
        $userInfo = $this->userObj->getAttributes();
        
        if ($userInfo[$this->userObj->getPrimaryKey()]!= null) {
         //  print_r("Si existe");
            return true;
        }
        else{
         //   echo "Usuario no válido";
            return false;
        }
    }

    public function setSessionVariables($userInfo){
      $_SESSION[$this->userObj->getPrimaryKey()] = $userInfo[$this->userObj->getPrimaryKey()];
      foreach ($userInfo as $key => $value) {
          $_SESSION[$key] = $userInfo[$key];
      }
    }
    
    public function setVariables($userInfo){
      //session_start();
      foreach ($userInfo as $key => $value) {
          $_SESSION[$key] = $userInfo[$key];
      }
    }
}
?>
