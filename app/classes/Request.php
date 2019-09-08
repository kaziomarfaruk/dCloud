<?php

namespace App\Classes;

class Request{
    public static function all($is_array = false){
        $result = [];
        if(count($_GET)>0) $result['get'] = $_GET;
        if(count($_POST)>0) $result['post'] = $_POST;
        $result['file'] = $_FILES;
        return json_decode(json_encode($result),$is_array);
    }

    public static function get($superGlobalType){
        $object = new static;
        $data = $object->all();
        return $data->$superGlobalType;
    }

    public static function has($superGlobalType){
        return array_key_exists(strtolower($superGlobalType),self::all(true))?true:false;
    }

    public static function old($superGlobalType,$value){
        $object = new static;
        $data = $object->all();
        //$data = self::all();
        isset($data->$superGlobalType->$value) ? $data->$superGlobalType->$value : '';
    }

    public static function refresh(){
        $_POST  = [];
            $_GET  = [];
                $_FILES  = [];
    }






}