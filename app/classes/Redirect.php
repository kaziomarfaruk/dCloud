<?php
/**
 * Created by PhpStorm.
 * User: dips1337x
 * Date: 12/12/2018
 * Time: 18:38
 */
namespace App\Classes;

class Redirect{

    public static function to($page){
        header('location: ',$page);
    }

    public static function back(){
        $uri = $_SERVER['REQUEST_URI'];
        header('location: ',$uri);
    }

}