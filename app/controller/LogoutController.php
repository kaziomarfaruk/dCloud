<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 29/03/2019
 * Time: 10:01
 */

namespace App\Controller;


class LogoutController
{

    public function __construct()
    {
        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

    }



    public function logout(){
        if(session_destroy()){
            return header('Location: /');
        }
    }




}