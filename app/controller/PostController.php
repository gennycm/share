<?php

class PostController extends Controller{
    private $action;

    public function __construct(){
        $params = array();
        $this->accessControl = array(
        "savePost"=>array('admin','public'),
        "listPostsByUser"=>array('admin','public'),
        "downloadPost"=>array('admin'));
    }


    public function listPostsByUser(){
        $post = new Post();
        $postsList = $post->listAllPostsFromUser();
        return $postsList;
    }

    public function listUserFriendsPosts(){
        $post = new Post();
        $postsList = $post->listAllFriendsPosts();
        return $postsList;
    }

    public function savePost(){
        $postData = $this->getParams();
        $filepath = $postData["filename"];
        $description = (isset($postData["description"]))? $postData["description"] : "Uknown";
        session_start();
        $id_user =  $_SESSION["id_user"]; //NECESITAMOS EL ID DEL USUARIO EN SESSION. 

        $destination_path = getcwd()."\\app\\user_files".DIRECTORY_SEPARATOR;
        $target_path = $destination_path . basename($filepath);
        $filepath_tmp = $postData["filename_tmp"];

        if($this -> uploadFile($filepath_tmp, $target_path)){
            $attributes = array("id_post" => null,"id_user" => $id_user, "description" => $description, "filepath" => $filepath);
            $post = new Post();
            $post -> setAttributes($attributes);
            $post -> savePost();
            header("Location: ../UserController/misArchivos");
        }
    }

    private function uploadFile($filepath_tmp, $filepath){
        if(is_file($filepath_tmp) == 1){
            return move_uploaded_file($filepath_tmp, $filepath);
        }
        else{
            return false;
        }
    }

    public function downloadPost(){
        $postData = $this->getParams();
        $idPost = $postData["id_post"];

        session_start();
        if(!isset($_SESSION["id_user"])){//$_SESSION["id_user"]
            header("Location: login");
        }

        $post = new Post();
        $post->setAttributes($postData);
        $post = $post->find();
        $postAttr = $post->getAttributes();
        $destination_path = getcwd()."\\app\\user_files".DIRECTORY_SEPARATOR;

            $file_name = $postAttr["filepath"];
            if(is_file($destination_path.$file_name)){
                $ext = pathinfo($destination_path.$file_name, PATHINFO_EXTENSION);
                header("Content-disposition: attachment; filename=".basename($file_name));
                header("Content-type: ".$this->getContentType());
                readfile($destination_path.$file_name);
            }
            else{
                echo "Archivo no encontrado";

            }
            
    }

    public function getContentType($ext){
        $ctype = "";
            switch($ext) {
            case "pdf":
                $ctype = "application/pdf";
                break;
            case "exe":
                $ctype = "application/octet-stream";
                break;
            case "zip":
                $ctype = "application/zip";
                break;
            case "doc":
                $ctype = "application/msword";
                break;
            case "xls":
                $ctype = "application/vnd.ms-excel";
                break;
            case "ppt":
                $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                break;
            case "jpeg":
                $ctype = "image/jpg";
                break;
            case "jpg":
                $ctype = "image/jpg";
                break;
            case "mp3":
                $ctype = "audio/mp3";
                break;
            case "wav":
                $ctype = "audio/x-wav";
                break;
            case "wma":
                $ctype = "audio/x-wav";
                break;
            case "mpeg":
                $ctype = "video/mpeg";
                break;
            case "mpg":
                $ctype = "video/mpeg";
                break;
            case "mpe":
                $ctype = "video/mpeg";
                break;
            case "mov":
                $ctype = "video/quicktime";
                break;
            case "avi":
                $ctype = "video/x-msvideo";
                break;
            case "src":
                $ctype = "plain/text";
                break;
            default:
                $ctype = "application/force-download";
        }

        return $ctype;

    }
    
}
?>