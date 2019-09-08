<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 16/03/2019
 * Time: 19:45
 */

namespace App\Controller;


use App\Classes\Request;
use App\Classes\UploadFile;

class BlogController
{


    public function blog(){

        return view('blog.blog',['kazi'=>'data']);
    }


    public function pricing(){

        //echo "inside home";
        if(isset($_SESSION['LoggedUserId'])){
            header('Location: /upgrade');
        }else{
            return view('blog.pricing',[]);
        }

    }


    public function contact(){

        //echo "inside home";

        return view('blog.contact',['kazi'=>'data']);

    }







}