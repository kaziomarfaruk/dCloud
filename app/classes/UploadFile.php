<?php
/**
 * Created by PhpStorm.
 * User: dips1337x
 * Date: 13/12/2018
 * Time: 15:47
 */

namespace App\Classes;

class UploadFile
{

    protected $name;
    protected $maxSize;
    protected $extention;
    protected $path;

    public function getName(){
        return $this->name;
    }

    public function setName($file,$name=""){
       if($name === ""){
           $name = pathinfo($file,PATHINFO_FILENAME);
       }
       $name = strtolower(str_replace(['-',' ',',','.','$','%'],'_',$name));
       $hash = md5(microtime());
       $ext = $this->fileExtention($file);
       $this->name = $name.'_'.$hash.'.'.$ext;
    }

    protected function fileExtention($file){
        return $this->extention = pathinfo($file,PATHINFO_EXTENSION);
    }

    public static function fileSize($file){
        $fileObj = new static;
        // return $file>$fileObj->maxSize ? Session::add('FILESIZE_ERROR','File is larger than '.$fileObj->maxSize):'';
        // return $file>self::$maxSize ? true:false;
        // Or
        return $file>$fileObj->maxSize ? true:false;
    }

    public static function isImage($file){
        $fileObj = new static;
        $ext = $fileObj->extention;
        $validExt = ['jpg','jpeg','png','bmp','gif'];
        if(!in_array(strtolower($ext),$validExt)){
            return false;
        }
        return true;
    }

    public function path(){
        return $this->path;
    }

    public static function move($temp,$destFolder,$file,$newFileName){



        $fileObj = new static;
        $fileObj->setName($file,$newFileName);
        $fileName = $fileObj->getName();

        /*
        if(!is_dir($destFolder)){
            mkdir($destFolder,0777,true);
        }
        */
        $fileObj->path = $destFolder.DIRECTORY_SEPARATOR.$fileName;
        $absolute_path = BASEPATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$fileObj->path;

        //$absolute_path = "upload/";
        //getcwd();

        //mkdir($destFolder,0777,true);
        if(move_uploaded_file($temp,$absolute_path)){
            return $fileObj;
        }
        return null;
    }











}