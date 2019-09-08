<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 20/03/2019
 * Time: 23:44
 */

namespace App\Controller;


class TrashController
{

    private $RawConnect;

    public function __construct()
    {

        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

        $RawDB = new \App\Classes\RawDatabase();
        $this->RawConnect = $RawDB->getConnection();

    }


    public function trash(){

        return view('blog.trash',[]);

    }


    public function trashDeleteFolder($id){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $parent_folder_id = $getarr[4];

        $childArr = [];

        $ParentChildController = new ParentChildController();;
        $childArr = $ParentChildController->getAllChildAsArray($parent_folder_id,null);

        if(!empty($childArr)){
            for($i=0;$i<count($childArr);$i++){
                $sql = "SELECT * FROM cloud where id = '{$childArr[$i]}'";
                $rslt = mysqli_query($this->RawConnect,$sql);
                $row = mysqli_fetch_assoc($rslt);
                //echo $row['file_name'].'<br>';

                if($row['type']=='folder'){
                    $deleteSql = "delete from cloud where id = '{$row['id']}'";
                    mysqli_query($this->RawConnect,$deleteSql);
                }else{
                    $deleteSql = "delete from cloud where id = '{$row['id']}'";
                    mysqli_query($this->RawConnect,$deleteSql);
                    $target_dir = "storage/{$row['unique_id']}";
                    unlink($target_dir);
                }
            }
        }

        $topParentDeleteSql = "delete from cloud where id = '{$parent_folder_id}'";
        $rslt = mysqli_query($this->RawConnect,$topParentDeleteSql);
        header("Location: ".getenv('APP_URL')."/trash");
    }




    public function trashDeleteFile($id){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $id = $getarr[4];
        $sql = "SELECT * FROM cloud where id = '{$id}'";
        $rslt = mysqli_query($this->RawConnect,$sql);
        $row = mysqli_fetch_assoc($rslt);
        $target_dir = "storage/{$row['unique_id']}";
        unlink($target_dir);

        $deleteSql = "delete from cloud where id = '{$row['id']}'";
        mysqli_query($this->RawConnect,$deleteSql);


        //$storageController = new StorageController();
        //$used_storage = (double) ($storageController->getUserUsedStorage())-$row[];


        header("Location: ".getenv('APP_URL')."/trash");

    }


    public function trashRestoreFolder($id){
        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $parent_folder_id = $getarr[4];

        $childArr = [];

        $ParentChildController = new ParentChildController();;
        $childArr = $ParentChildController->getAllChildAsArray($parent_folder_id,null);

        if(!empty($childArr)){
            for($i=0;$i<count($childArr);$i++){
                $sql = "SELECT * FROM cloud where id = '{$childArr[$i]}'";
                $rslt = mysqli_query($this->RawConnect,$sql);
                $row = mysqli_fetch_assoc($rslt);
                //echo $row['file_name'].'<br>';

                if($row['type']=='folder'){
                    $restoreSql = "update cloud set trashed = 0 where id = '{$row['id']}'";
                    mysqli_query($this->RawConnect,$restoreSql);
                }else{
                    $restoreSql = "update cloud set trashed = 0 where id = '{$row['id']}'";
                    mysqli_query($this->RawConnect,$restoreSql);
                }
            }
        }

        $topParentRestoreSql = "update cloud set trashed = 0 where id = '{$parent_folder_id}'";
        $rslt = mysqli_query($this->RawConnect,$topParentRestoreSql);
        header("Location: ".getenv('APP_URL')."/trash");

    }



    public function trashRestoreFile($id){
        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $id = $getarr[4];

        $restoreSql = "update cloud set trashed = 0 where id = '{$id}'";
        mysqli_query($this->RawConnect,$restoreSql);

        header("Location: ".getenv('APP_URL')."/trash");
    }




}