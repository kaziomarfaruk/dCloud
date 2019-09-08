<?php
/**
 * Created by PhpStorm.
 * User: dips1337x
 * Date: 11/12/2018
 * Time: 11:25
 */

namespace App\Classes;


class CSRFtoken{

    public static function _token(){
        if(!Session::has('CSRFtoken')){
            Session::add('CSRFtoken',base64_encode(openssl_random_pseudo_bytes(32))); /* */
        }
        return Session::get('CSRFtoken');
    }
    public static function verify($token){
        if(Session::has('CSRFtoken') &&  Session::get('CSRFtoken')===$token){
            return true;
        }
        return false;
    }





}