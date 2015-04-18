<?php
class SystemUser{
    public $id;
    public $loggedUser;
    public $isLogged;
    private $user;
    private $userObj;
    
    public function login($userData, $tbName){
       if($this->authenticate($userData, $tbName)){
          session_start();
          $user = $this->userObj->getAttributes();
          $this->id = $user[$this->userObj->getPrimaryKey()];
          $this->loggedUser = $this->userObj;
          $this->isLogged = true;
       }else{
          $this->isLogged = false;
       }
    }
    
    public function logout(){
        session_destroy();
        $this->isLogged = false;
    }
    
    public function authenticate($userData, $tbName){

        $result = DBConnection::getInstance()->getDBCommand()->select($userData, $tbName);
        $user = Array();
        foreach ($result as $auxArray) {
            foreach ($auxArray as $key => $value) {
              if(!is_numeric($key)) {
                $user[$key] = $value;
              }
            }
          }
        $this->userObj = new User();
        $this->userObj->setAttributes($user);
        $user = $this->userObj->getAttributes();
        
        if ($user[$this->userObj->getPrimaryKey()]!= null) {
         //  print_r("Si existe");
            return true;
        }
        else{
         //   echo "Usuario no válido";
            return false;
        }
    }
}
?>
