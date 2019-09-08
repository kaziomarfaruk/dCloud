<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 16/03/2019
 * Time: 19:45
 */

namespace App\Controller;


use App\Classes\Request;
use App\Classes\UploadFile;

class HomeController
{



    private $RawConnect;

    public function __construct()
    {
        if(empty($_SESSION['LoggedUserId'])){
            header('Location: /login');
        }
        $RawDB = new \App\Classes\RawDatabase();
        $this->RawConnect = $RawDB->getConnection();

    }


    public function home(){

        if(empty($_SESSION['LoggedUserId'])){
           header('Location: /login');
        }else{
            return view('blog.home',[]);
        }


    }


    public function upload(){

        return view('blog.upload',['kazi'=>'My name is kazi dio','omar'=>'prefix omar']);

    }


    public function folder(){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $parent_id = $getarr[2];
        return view('blog.folder',['parent_id'=>$parent_id]);

    }



    public function fileRename(){

        $file_new_name = $_POST['new_name'];
        $file_id = $_POST['id'];

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "UPDATE cloud set file_name = '{$file_new_name}' where id = '{$file_id}'";
        $rslt = mysqli_query($RawConnect,$sql);

        header("Location: ".getenv('APP_URL')."/home");

        $RawConnect->close();
    }


    public function fileDelete(){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $file_id = $getarr[3];
        //die();

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "UPDATE cloud set trashed = 1 where id = '{$file_id}'";
        $rslt = mysqli_query($RawConnect,$sql);


        $search_private_rslt = mysqli_query($RawConnect,"SELECT * FROM private_share where file_id = $file_id");
        if(mysqli_num_rows($search_private_rslt)>0){
            $private_delete_sql = "delete from private_share where file_id = $file_id";
            $private_delete_rslt = mysqli_query($RawConnect,$private_delete_sql);
        }



        header("Location: ".getenv('APP_URL')."/home");

        $RawConnect->close();
    }


    public function folderDelete(){

        //echo 'folder';
        //die();

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $parent_folder_id = $getarr[3];

        //echo $this->getAllChildAsString($parent_folder_id,'');
        //var_dump($this->getAllChildAsArray($parent_folder_id,null));

        $ParentChildController = new ParentChildController();;
        $childArr = $ParentChildController->getAllChildAsArray($parent_folder_id,null);

        //var_dump($childArr);

        for($i=0;$i<count($childArr);$i++){
            $sql = "UPDATE cloud set trashed = 1 where id = '{$childArr[$i]}'";
            $rslt = mysqli_query($this->RawConnect,$sql);
        }

        $sql = "UPDATE cloud set trashed = 1 where id = '{$parent_folder_id}'";
        $rslt = mysqli_query($this->RawConnect,$sql);




//        $search_private_rslt = mysqli_query($this->RawConnect,"SELECT * FROM private_share where file_id = $id");
//        if(mysqli_num_rows($search_private_rslt)>0){
//            $private_delete_sql = "delete from private_share where file_id = $id";
//            $private_delete_rslt = mysqli_query($this->RawConnect,$private_delete_sql);
//        }




        header("Location: ".getenv('APP_URL')."/home");

        $this->RawConnect->close();
    }


    public function folderCreate(){

        $userId = $_SESSION['LoggedUserId'] ;

        $folder_name = $_POST['folder_name'];
        $parent_id = $_POST['parent_id'];

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "INSERT INTO `cloud` (`id`, `file_name`, `user_id`, `parent_id`, `type`, `size`, `modified_at`, `public_share`, `unique_id`, `ext`, `path`, `trashed`) 
VALUES (NULL, '{$folder_name}', '{$userId}', '{$parent_id}', 'folder', null, NOW(), '0', '', '', '', '0');";

        //die();
        $rslt = mysqli_query($RawConnect,$sql);

        if($parent_id == null || $parent_id == 0 ){
            header("Location: ".getenv('APP_URL')."/home");
        }else{
            header("Location: ".getenv('APP_URL')."/folder/".$parent_id);
        }

        $RawConnect->close();
    }






}