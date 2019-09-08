<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 06/04/2019
 * Time: 20:25
 */

namespace App\Controller;


class AdminController
{


    function __construct()
    {

    }

    public function adminLoginView(){

        return view('blog.adminLogin',[]);
    }

    public function adminLoginAction(){


        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = md5($_POST['email']);

        if($email == 'dipsgalaxy01@gmail.com' && $password == '0f3d158de99f305de596b50627040058'){

            $_SESSION['LoggedInAdminEmail'] = 'dipsgalaxy01@gmail.com';

            return header("Location: /admin");
            //echo 'success';
        }else{
            $_SESSION['AdminLoginFailed'] = 'Sign in as admin failed.Wrong try may ban our ip.';
            return header("Location: /admin/login");
        }


    }

    public function admin(){


        if(empty($_SESSION['LoggedInAdminEmail'])){
            header('Location: /');
        }

        header("Location: ".getenv('APP_URL')."/updateStoragePolicy");
    }


    public function adminLogout(){

        if(empty($_SESSION['LoggedInAdminEmail'])){
            header('Location: /');
        }

        session_destroy();
        return header('Location: /');
        //return view('blog.admin',[]);
    }

    public function updateHomePage(){

        return view('blog.admin',[]);
    }

    public function updateContact(){

        return view('blog.admin',[]);
    }

    public function updateStoragePolicy(){


        if(empty($_SESSION['LoggedInAdminEmail'])){
            header('Location: /');
        }

        return view('blog.adminStoragePolicy',[]);
    }

    public function adminStoragePolicyUpdateAction(){

        if(empty($_SESSION['LoggedInAdminEmail'])){
            header('Location: /');
        }

        $package = $_POST['package'];
        $storage = $_POST['storage'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "UPDATE storage_policy set package = '{$package}', storage = '{$storage}', price = '{$price}'  where id = '{$id}'";
        $rslt = mysqli_query($RawConnect,$sql);

        header("Location: ".getenv('APP_URL')."/updateStoragePolicy");
    }


    public function StoragePolicyAdd(){

        if(empty($_SESSION['LoggedInAdminEmail'])){
            header('Location: /');
        }

        $package = $_POST['package'];
        $storage = $_POST['storage'];
        $price = $_POST['price'];

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        mysqli_query($RawConnect,"INSERT INTO `storage_policy` (`id`, `package`, `storage`, `price`) VALUES (NULL, '{$package}', '{$storage}', '{$price}');");

        header("Location: ".getenv('APP_URL')."/updateStoragePolicy");
    }


    public function packageDelete(){

        if(empty($_SESSION['LoggedInAdminEmail'])){
            header('Location: /');
        }

        $id = explode('/',$_SERVER['REQUEST_URI'])[2];

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        mysqli_query($RawConnect,"DELETE FROM `storage_policy` WHERE `storage_policy`.`id` = {$id}");

        header("Location: ".getenv('APP_URL')."/updateStoragePolicy");
    }



}