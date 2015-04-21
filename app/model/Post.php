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

  function listAllPostsFromUser($id_user){
    $query = "SELECT * FROM ".$this->getTableName()." WHERE id_user= ".$id_user.")";
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

}

?>

