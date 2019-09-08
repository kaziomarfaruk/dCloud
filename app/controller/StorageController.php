<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 05/04/2019
 * Time: 14:52
 */

namespace App\Controller;


class StorageController
{


    public function __construct()
    {
        if(empty($_SESSION['LoggedUserId'])){
            return header('Location: /login');
        }

    }

    public function getUserUsedStorage(){
        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $result = mysqli_query($RawConnect,"SELECT * FROM cloud where trashed = 0 and user_id = ".$_SESSION['LoggedUserId']);
        $numRows = mysqli_num_rows($result);
        $usedStorage = null;
        if($numRows>0){
            while($row = mysqli_fetch_assoc($result)){
                $usedStorage += $row['size'];
            }
        }else{
            $usedStorage = 0;
        }
        return $usedStorage;

    }


    public function getUserReserveStorage(){
        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();
        $LoggedUserId = $_SESSION['LoggedUserId'];
        $result = mysqli_query($RawConnect,"SELECT * FROM user where id = $LoggedUserId");
        $rst = mysqli_fetch_assoc($result);
        return $rst['storage'];
    }


    public function upgrade(){


        return view('blog.upgrade',[]);
    }


    public function upgradeP1(){

        /*
            1kb = 1000 byte
            500kb = 500,000 byte
            1mb = 1000,000 byte
            500mb = 500000000 byte
            1gb =  1000000000 byte
        */

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $user_sorage = $this->getUserReserveStorage()+500000000;

        //510000000

        $rslt = mysqli_query($RawConnect,"update user set storage = {$user_sorage} where id = ".$_SESSION['LoggedUserId']);

        $_SESSION['StorageUpgradeSuccessful'] = 'Your Storage has been successfully upgraded.';
        header('Location: /home');
        //return view('blog.upgrade',[]);
    }


    public function upgradeP2(){

        /*
            1kb = 1000 byte
            500kb = 500,000 byte
            1mb = 1000,000 byte
            500mb = 500000000 byte
            1gb =  1000000000 byte
        */

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $user_sorage = $this->getUserReserveStorage()+1000000000;

        //510000000

        $rslt = mysqli_query($RawConnect,"update user set storage = {$user_sorage} where id = ".$_SESSION['LoggedUserId']);

        $_SESSION['StorageUpgradeSuccessful'] = 'Your Storage has been successfully upgraded.';
        header('Location: /home');
        //return view('blog.upgrade',[]);
    }

    public function upgradeStorage(){

        /*
            1kb = 1000 byte
            500kb = 500,000 byte
            1mb = 1000,000 byte
            500mb = 500000000 byte
            1gb =  1000000000 byte
        */
        $storage = (double)explode('/',$_SERVER['REQUEST_URI'])[3];

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $user_sorage = $this->getUserReserveStorage()+$storage;

        //510000000

        $rslt = mysqli_query($RawConnect,"update user set storage = {$user_sorage} where id = ".$_SESSION['LoggedUserId']);

        $_SESSION['StorageUpgradeSuccessful'] = 'Your Storage has been successfully upgraded.';
        header('Location: /home');
        //return view('blog.upgrade',[]);
    }




}