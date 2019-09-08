<?php
/**
 * Created by PhpStorm.
 * User: dips1337x
 * Date: 09/12/2018
 * Time: 11:56
 */

namespace App\Classes;


class Session{

    public static function add($name,$value){
        if($name!='' && !empty($name) && $value != '' && !empty($value) ){
            return $_SESSION[$name] = $value;
        }
        throw new \Exception('Session Name And Value Required');
    }


    public static function get($name){
        return $_SESSION[$name];
    }

    public static function has($name){
        if($name!='' && !empty($name)){
            return !empty($_SESSION[$name]) ? true : false;
        }
        throw new \Exception('Name is required');
    }

    public static function remove($name){
        if(self::has($name)){
            unset($_SESSION[$name]);
        }
    }



}