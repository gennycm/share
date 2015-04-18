<?php
//extends ActiveRecord
//la tabla se llama igual que el modelo
    include_once('/../../mvc/database/ActiveRecord.php');

class User extends ActiveRecord{ 
    //ya no sera necesario que declare los atributos
  function registerUser(){
  	$this->save();
  }

  function modifyUser(){
  	$this->update();
  }

  function findUserById(){
  	$this->find();
  }

  function listAllUsers(){
  	$this->findAll();
  }

  function modifyUserInfo(){
  	$this->save();
  }

}

?>

