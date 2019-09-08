<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 21/03/2019
 * Time: 00:10
 */

namespace App\Controller;


class RecentController
{

    public function __construct()
    {

        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

        $RawDB = new \App\Classes\RawDatabase();
        $this->RawConnect = $RawDB->getConnection();

    }



    public function recent(){

        return view('blog.recent',['kazi'=>'My name is kazi dio','omar'=>'prefix omar']);

    }


}