<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 20/03/2019
 * Time: 23:49
 */

namespace App\Controller;

class ParentChildController
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


    /* get all child as array */
    public function getAllChildAsArray($parent_id = 0, $sub_mark=[]){
        $query = mysqli_query($this->RawConnect,"SELECT * FROM cloud WHERE parent_id = $parent_id");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                //echo $row['file_name'].'<br>';
                $sub_mark[] = $row['id'];
                $sub_mark = $this->getAllChildAsArray($row['id'], $sub_mark);
            }
        }
        return $sub_mark;
    }

    /* get all child as string */
    public function getAllChildAsString($parent_id = 0, $sub_mark=''){
        $query = mysqli_query($this->RawConnect,"SELECT * FROM cloud WHERE parent_id = $parent_id");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                //echo $row['file_name'].'<br>';
                $sub_mark .= $row['id'].'<br>';
                $sub_mark = $this->getAllChildAsString($row['id'], $sub_mark);
            }
        }
        return $sub_mark;
    }



    public function moveCreate()
    {

        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

        $_SESSION['move'] = explode('/',$_SERVER['REQUEST_URI'])[2];

        header('Location: /home');

    }


    public function move()
    {

        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

        $parent = explode('/',$_SERVER['REQUEST_URI'])[3];
        $id = explode('/',$_SERVER['REQUEST_URI'])[2];
        if(mysqli_query($this->RawConnect,"UPDATE cloud set parent_id = {$parent} where id = {$id}")){
            unset($_SESSION['move']);
            header('Location: /home');
        }


    }


    public function copyCreate()
    {

        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

        $_SESSION['copy'] = explode('/',$_SERVER['REQUEST_URI'])[2];

        header('Location: /home');

    }

    public function copy()
    {

        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

        $parent = explode('/',$_SERVER['REQUEST_URI'])[3];
        $id = explode('/',$_SERVER['REQUEST_URI'])[2];

        $row = mysqli_query($this->RawConnect,"SELECT * FROM CLOUD WHERE id = $id");
        //echo '<pre>';
        $rslt = mysqli_fetch_assoc($row);
        //echo '</pre>';

                $sql = "INSERT INTO `cloud` (`id`, `file_name`, `user_id`, `parent_id`, `type`, `size`, `modified_at`, `public_share`, `unique_id`, `ext`, `path`, `trashed`) 
VALUES (NULL, '{$rslt['file_name']}', '{$rslt['user_id']}', '{$parent}', '{$rslt['type']}', '{$rslt['size']}', NOW(), '0', '{$rslt['unique_id']}', '{$rslt['ext']}', '{$rslt['path']}', '0');";

                if(mysqli_query($this->RawConnect,$sql)){
                    $storageController = new StorageController();
                    $used_storage = (double) ($storageController->getUserUsedStorage());
                    $reserveStorage = (double) ($storageController->getUserReserveStorage());
                    $limit = $reserveStorage-$used_storage; //100MB

                    if($rslt['size'] < $limit) {
                        $updateuserstorage = $used_storage+$rslt['size'];
                        $userId = $_SESSION['LoggedUserId'];
                        mysqli_query($this->RawConnect, "UPDATE USER SET used_storage = {$updateuserstorage} where id = {$userId}");
                        return header('Location: /home');
                    }else{
                        $_SESSION['StorageLimitError'] = 'File size exceed your data limit.Please upgrade your storage or delete some from cloud.';
                        return header('Location: /home');
                    }
                }




    }




}