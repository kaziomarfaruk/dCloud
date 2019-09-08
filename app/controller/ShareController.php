<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 21/03/2019
 * Time: 00:09
 */

namespace App\Controller;


class ShareController extends BaseController
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



    public function shared(){

        return view('blog.shared',[]);

    }

    public function publicShare(){

        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }




        return view('blog.publicshare',[]);

    }



    public function privateShare(){

        return view('blog.privateshare',['kazi'=>'My name is kazi dio','omar'=>'prefix omar']);

    }


    public function publicShareRemove(){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $file_id = $getarr[2];

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "UPDATE cloud set public_share = '0' where id = '{$file_id}' and user_id = ".$_SESSION['LoggedUserId']."";
        $rslt = mysqli_query($RawConnect,$sql);

        header("Location: ".getenv('APP_URL')."/share/".$_SESSION['LoggedUserId']."/".$_SESSION['LoggedUserSalt']);

    }

    public function privateShareRemove(){


        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $file_id = $getarr[2];
        $shared_with = $_SESSION['LoggedUserEmail'];
        //die();
        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "DELETE FROM `private_share` WHERE `private_share`.`id` = $file_id and `private_share`.`shared_with` = '{$shared_with}'";

        $rslt = mysqli_query($RawConnect,$sql);

        header("Location: ".getenv('APP_URL')."/private/share/".$_SESSION['LoggedUserId']);

    }




    public function publicShareAction(){

        $str = $_SERVER['REQUEST_URI'];
        $getarr = explode('/',$str);
        $file_id = $getarr[2];
        //die();

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "UPDATE cloud set public_share = 1 where id = '{$file_id}'";
        $rslt = mysqli_query($RawConnect,$sql);

        header("Location: ".getenv('APP_URL')."/home");

        $RawConnect->close();

        return view('blog.publicshare',['kazi'=>'My name is kazi dio','omar'=>'prefix omar']);

    }


    public function personalShareAction(){

        //echo "person share";

        $file_id = $_POST['id'];
        $share_email = $_POST['share_email'];
        //die();

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $user_id = null;

        $isExists = 0;

        $query = mysqli_query($this->RawConnect,"SELECT * FROM user ");

        while($rslt = mysqli_fetch_assoc($query)){
            if($rslt["email"]==$share_email){
                $isExists = 1;
                $user_id = $rslt["id"];
                break;
            }
        }

        if($isExists ==1) {
            $sql = "INSERT INTO private_share(file_id,shared_with,user_id) values('{$file_id}','{$share_email}','{$user_id}')";
            $rslt = mysqli_query($RawConnect,$sql);

            header("Location: ".getenv('APP_URL')."/home");

            $RawConnect->close();

        }else{

            echo '<script>alert("User Does not exists")</script>';

        }



        return view('blog.home',['error'=>'User does not exists.']);

    }


}