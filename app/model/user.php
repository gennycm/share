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

  function getUsersFriends($idUser){
    $query = "SELECT ".$this->getTableName().".id_user, username, name from (select id_user from friends where id_friend = ".$idUser." union select id_friend from friends where id_user= ".$idUser.") AS friendsTb join ".$this->getTableName()." on friendsTb.id_user = ".$this->getTableName().".id_user";
    $result = $this->executeQuery($query);
    $friends = Array();
    $friend = Array();
      foreach ($result as $auxArray) {
        foreach ($auxArray as $key => $value) {
          if(!is_numeric($key)) {
              $friend[$key] = $value;
            }
          }
          array_push($friends, $friend);
        }
    return $friends;
  }


  function getPosibleFriends($idUser){
    $query = "SELECT ".$this->getTableName().".id_user, username, name from user WHERE id_user NOT IN (SELECT ".$this->getTableName().".id_user from (select id_user from friends where id_friend = ".$idUser." union select id_friend from friends where id_user= ".$idUser." ) AS friendsTb join ".$this->getTableName()." on friendsTb.id_user = ".$this->getTableName().".id_user)AND id_user != ".$idUser;
    $result = $this->executeQuery($query);
    $friends = Array();
    $friend = Array();
      foreach ($result as $auxArray) {
        foreach ($auxArray as $key => $value) {
          if(!is_numeric($key)) {
              $friend[$key] = $value;
            }
          }
          array_push($friends, $friend);
        }
    return $friends;
  }

  function searchFriend($idUser, $friendName){
    $query = "SELECT * FROM ( SELECT ".$this->getTableName().".id_user, username, name from user WHERE id_user NOT IN (SELECT ".$this->getTableName().".id_user from (select id_user from friends where id_friend = ".$idUser." union select id_friend from friends where id_user= ".$idUser." ) AS friendsTb join ".$this->getTableName()." on friendsTb.id_user = ".$this->getTableName().".id_user)AND id_user != ".$idUser.") AS notFriends WHERE username LIKE %".$friendName."% or name LIKE %".$friendName."%";
    $result = $this->executeQuery($query);
    $friends = Array();
    $friend = Array();
      foreach ($result as $auxArray) {
        foreach ($auxArray as $key => $value) {
          if(!is_numeric($key)) {
              $friend[$key] = $value;
            }
          }
          array_push($friends, $friend);
        }
    return $friends;
  }
}

?>

