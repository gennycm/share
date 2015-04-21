<?php

class PostController extends Controller{
    private $action;

    public function __construct(){
        $params = array();
    }


    public function listPostsByUser($id_user){
        $post = new Post();
        $postsList = $post->listAllPostsFromUser($id_user);
        $listPostsView = new PostList("list");
        echo $listPostsView->showPostsList($postsList);
    }

    public function savePost(){
        $filepath = (isset($_FILES["file"]["name"]))? $_FILES["file"]["name"] : "Uknown";
        $description = (isset($_POST["description"]))? $_POST["description"] : "Uknown";
        $id_user = 0; //NECESITAMOS EL ID DEL USUARIO EN SESSION. 
        //session_start();
        //$username = $_SESSION["username_shayourfiles"];

        $ext = pathinfo($filepath, PATHINFO_EXTENSION);
        $filepath = uniqid().".".$ext;
        $filepath_tmp = $_FILES["file"]["tmp_name"];

        if($this -> uploadFile($filepath_tmp, $filepath)){
            $attributes = array("filepath" => $filepath, "id_user" => $id_user, "description" => $description);
            $post = new Post();
            $post -> setAttributes($attributes);
            $post -> savePost();   
        }
    }

    private function uploadFile($filepath_tmp, $filepath){
        if(is_file($filepath_tmp) == 1){
            return move_uploaded_file($filepath_tmp, "./user_files/".$filepath);
        }
        else{
            return false;
        }
    }

    
}
?>