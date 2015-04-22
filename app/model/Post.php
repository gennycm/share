<?php
//extends ActiveRecord
//la tabla se llama igual que el modelo

class Post extends ActiveRecord{ 
    //ya no sera necesario que declare los atributos
  function savePost(){
  	$this->save();
  }

  function modifyPost(){
  	$this->update();
  }

  function findByPostId(){
  	$this->find();
  }

  function deletePost(){
    $this-> delete();
  }

  function listAllPostsFromUser(){
    $query = "SELECT * FROM ".$this->getTableName()." WHERE id_user= ".$_SESSION["id_user"];
    $result = $this->executeQuery($query);
    $posts = Array();
    $post = Array();
      foreach ($result as $auxArray) {
        foreach ($auxArray as $key => $value) {
          if(!is_numeric($key)) {
              $post[$key] = $value;
            }
          }
          array_push($posts, $post);
        }
    return $posts;
  }

  function listAllFriendsPosts(){
    $query = "select pTb.id_user, user.name, pTb.id_post, pTb.description, pTb.filepath from 
              (select fTb.id_user, ".$this->getTableName().".id_post, ".$this->getTableName().".description, ".$this->getTableName().".filepath from 
                (SELECT user.id_user from 
                  (select id_user from friends where id_friend = ".$_SESSION["id_user"]." union 
                    select id_friend from friends where id_user= ".$_SESSION["id_user"].") AS friendsTb 
                      join user on friendsTb.id_user = user.id_user) as fTb 
                        INNER JOIN ".$this->getTableName()." ON fTb.id_user = ".$this->getTableName().".id_user) as pTb 
                          inner join user on pTb.id_user = user.id_user";
    $result = $this->executeQuery($query);
    $posts = Array();
    $post = Array();
      foreach ($result as $auxArray) {
        foreach ($auxArray as $key => $value) {
          if(!is_numeric($key)) {
              $post[$key] = $value;
            }
          }
          array_push($posts, $post);
        }
    return $posts;
    var_dump($posts);
    exit();
  }

}

?>