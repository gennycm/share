<?php
//extends ActiveRecord
//la tabla se llama igual que el modelo

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

  function getUsersFriends(){
    $query = "SELECT ".$this->getTableName().".id_user, username, name from (select id_user from friends where id_friend = ".$_SESSION["id_user"]." union select id_friend from friends where id_user= ".$_SESSION["id_user"].") AS friendsTb join ".$this->getTableName()." on friendsTb.id_user = ".$this->getTableName().".id_user";
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


  function getPosibleFriends(){
    $query = "SELECT ".$this->getTableName().".id_user, username, name from user WHERE id_user NOT IN (SELECT ".$this->getTableName().".id_user from (select id_user from friends where id_friend = ".$_SESSION["id_user"]." union select id_friend from friends where id_user= ".$_SESSION["id_user"]." ) AS friendsTb join ".$this->getTableName()." on friendsTb.id_user = ".$this->getTableName().".id_user)AND id_user != ".$_SESSION["id_user"];
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

  function searchFriend($friendName){
    $friends = Array();
    $friend = Array();
    $query = "SELECT * FROM ( SELECT ".$this->getTableName().".id_user, username, name from user WHERE id_user NOT IN (SELECT ".$this->getTableName().".id_user from (select id_user from friends where id_friend = ".$_SESSION["id_user"]." union select id_friend from friends where id_user= ".$_SESSION["id_user"]." ) AS friendsTb join ".$this->getTableName()." on friendsTb.id_user = ".$this->getTableName().".id_user)AND id_user != ".$_SESSION["id_user"].") AS notFriends WHERE username LIKE '%".$friendName."%' or name LIKE '%".$friendName."%'";
    $result = $this->executeQuery($query);

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

  function deleteFriend($idFriend){
    $query = "DELETE FROM friends WHERE (id_user = ".$_SESSION["id_user"]." AND id_friend = ".$idFriend.") OR (id_user = ".$idFriend." AND id_friend = ".$_SESSION["id_user"].")";
    $result = $this->executeQuery($query);
  }

  function addFriend($idFriend){
    $query = "INSERT INTO friends(id_user,id_friend,status) VALUES (".$_SESSION["id_user"].",".$idFriend.",1)";
    $this->executeQuery($query);
  }

}

?>

