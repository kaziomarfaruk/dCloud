<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 21/03/2019
 * Time: 00:19
 */

namespace App\Controller;


class UploadDownloadController
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



    public function uploadAction(){

        $userId = $_SESSION['LoggedUserId'];
        $parent_id = $_POST['parent_id']; // root
        $file = $_FILES["uploadFile"];
        $fileName = $_FILES["uploadFile"]["name"];
        $fileTmpName = $_FILES["uploadFile"]["tmp_name"];
        $fileSize = $_FILES["uploadFile"]["size"];
        $fileError = $_FILES["uploadFile"]["error"];
        $fileType = $_FILES["uploadFile"]["type"];

        /*
            1kb = 1000 byte
            500kb = 500,000 byte
            1mb = 1000,000 byte
            1gb = 1000,000,000 byte
        */

        //$limit = 1000000; //1MB
        //$limit = 10000000; //10MB
        //$limit = 100000000; //100MB
        //$limit = 1000000000; //1000MB

        $storageController = new StorageController();
        $used_storage = (double) ($storageController->getUserUsedStorage());
        //echo '<br>';
        $reserveStorage = (double) ($storageController->getUserReserveStorage());
        //die();
        /*
        echo $used_storage = (double) ($this->getUserUsedStorage());
        echo '<br>';
        echo $reserveStorage = (double) ($this->getUserReserveStorage());
        */


        $limit = $reserveStorage-$used_storage; //100MB

        list($file_name,$file_ext) = explode('.',strtolower($fileName));
        $storageFileName = uniqid('dcloud.com.'.$userId.'.',true).'.'.$file_ext;

        if($fileSize < $limit){

            $target_dir = "storage/";
            $target_file = $target_dir.basename($storageFileName);
            $path = getenv('APP_URL').'/'.$target_file;
            if(move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)){
                //echo "File Upload success";
                $RawDB = new \App\Classes\RawDatabase();
                $RawConnect = $RawDB->getConnection();

                $sql = "INSERT INTO `cloud` (`id`, `file_name`, `user_id`, `parent_id`, `type`, `size`, `modified_at`, `public_share`, `unique_id`, `ext`, `path`, `trashed`) 
VALUES (NULL, '{$file_name}', '{$userId}', '{$parent_id}', '{$fileType}', '{$fileSize}', NOW(), '0', '{$storageFileName}', '{$file_ext}', '{$path}', '0');";

                $RawConnect->query($sql);

                /* UPDATE STORAGE */
                mysqli_query($RawConnect,"UPDATE USER SET used_storage = {$used_storage} where id = {$userId}");

            }

        }else{
            //echo "<script>alert('File size exceed your data limit.Please upgrade your storage or delete some from cloud.')</script>";
            //die();
            $_SESSION['StorageLimitError'] = 'File size exceed your data limit.Please upgrade your storage or delete some from cloud.';
        }

        unset($_FILES);
        ob_end_clean();
        ob_flush();
        header("Location: ".getenv('APP_URL').'/home');

    }

    public function getUserUsedStorage(){
        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $result = mysqli_query($RawConnect,"SELECT * FROM cloud where trashed = 0 and user_id = ".$_SESSION['LoggedUserId']);
        $numRows = mysqli_num_rows($result);
        $usedStorage = null;
        if($numRows>0){
            while($row = mysqli_fetch_assoc($result)){
                $usedStorage += $row['size'];
            }
        }else{
            $usedStorage = 0;
        }
        return $usedStorage;

    }


    public function getUserReserveStorage(){
        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();
        $LoggedUserId = $_SESSION['LoggedUserId'];
        $result = mysqli_query($RawConnect,"SELECT * FROM user where id = $LoggedUserId");
        $rst = mysqli_fetch_assoc($result);
        return $rst['storage'];
    }


    public function download($id){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $id = $getarr[2];

        $filepath = null;

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "SELECT * FROM cloud where id = $id";

        $result = mysqli_query($RawConnect,$sql);

        $numRows = mysqli_num_rows($result);

        $row = mysqli_fetch_assoc($result);


        if(extension_loaded('zip')){
            $zip = new \ZipArchive();
            $zipname = uniqid('download.zip.',true).'.zip';
            if($zip->open("storage/".$zipname,\ZipArchive::CREATE) != true){
                die("Server Error");
            }
            $zip->addFile('storage/'.$row["unique_id"],$row["file_name"].'.'.$row["ext"]);
            $zip->close();
            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename = storage/".$zipname);
            readfile("storage/".$zipname);
            unlink("storage/".$zipname);

        }

        $RawConnect->close();

    }



    public function folderDownload(){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $parent_folder_id = $getarr[3];

        $zip = new \ZipArchive();
        $zipname = uniqid('zip.dCloud.com.',true).'.zip';
        if($zip->open("storage/".$zipname,\ZipArchive::CREATE) != true){
            die("Server Error");
        }

        $ParentChildController = new ParentChildController();;
        $childArr = $ParentChildController->getAllChildAsArray($parent_folder_id,null);

        if(!empty($childArr)){
            for($i=0;$i<count($childArr);$i++) {
                $sql = "SELECT * FROM cloud WHERE id = '{$childArr[$i]}'";
                $result = mysqli_query($this->RawConnect,$sql);
                $row = mysqli_fetch_assoc($result);
                if($row['type'] != 'folder'){
                    $zip->addFile('storage/'.$row["unique_id"],$row["file_name"].'.'.$row["ext"]);
                }

            }
        }

        $zip->close();
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename = storage/".$zipname);
        readfile("storage/".$zipname);
        unlink("storage/".$zipname);
        $this->RawConnect->close();

    }



}