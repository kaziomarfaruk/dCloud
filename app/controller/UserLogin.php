<?php


namespace App\Controller;

use App\Classes\Mailer;
use App\classes\RawDatabase;

class UserLogin
{
    private $RawConnect;

    public function __construct()
    {

        if(!empty($_SESSION['LoggedUserId'])){
            header('Location: /');
        }

        $RawDB = new \App\Classes\RawDatabase();
        $this->RawConnect = $RawDB->getConnection();

    }


    public function login(){

        return view('blog.login',[]);

    }

    public function action(){

        $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        $password = sha1($_POST["password"]);



        $result = mysqli_query($this->RawConnect,"SELECT * FROM user where email = '{$email}'");
        $numRows = mysqli_num_rows($result);
        if($numRows ==0){
            $_SESSION['LoginFailed'] = 'Login Failed.Please try using correct email and password.';
            return header('Location: /login');
        }


        $isExists = 0;

        $query = mysqli_query($this->RawConnect,"SELECT * FROM user ");

        while($rslt = mysqli_fetch_assoc($query)){
            if($rslt["email"]==$email && $rslt["password"]==$password){
                $isExists = 1;
                $_SESSION['LoggedUserEmail'] = $rslt["email"];
                $_SESSION['LoggedUserId'] = $rslt["id"];
                $_SESSION['LoggedUserSalt'] = $rslt["salt"];
                break;
            }
        }

        if($isExists ==1) {
//            return view('blog.home', []);
            return header('Location: /home');
        }else{
            return view('blog.login',['loginFailed' => 'Login Failed']);
        }

    }



    public function logout(){
        if(session_destroy()){
            return header('Location: /');
        }
    }


    public function recover(){

        return view('blog.user-recover',[]);
    }


    public function recoverAction(){

        $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        $token = md5($email);

        $result = mysqli_query($this->RawConnect,"SELECT * FROM user where email = '{$email}'");
        $numRows = mysqli_num_rows($result);
        if($numRows ==0){
            $_SESSION['UserNotExists'] = 'No user found';
            return header('Location: /user/recover');
        }


        $query = mysqli_query($this->RawConnect,"SELECT * FROM  user where email = '{$email}' Limit 1");

        iF($rslt = mysqli_fetch_assoc($query)){
            $mailer = new Mailer();
            $data = [
                'to'      =>       $rslt["email"],
                'subject' =>       'dCloud.com user recover mail',
                'view'    =>       'welcome',
                'name'    =>       $rslt["username"],
                'body'    =>       'http://dcloud.com/user_recover/'.$rslt["salt"]
            ];

            if($mailer->send($data)){
                $_SESSION['UserRecoverEmailSentSuccess'] = 'A recover email has been sent.';

            }else{
                $_SESSION['UserRecoverEmailSentFailure'] = 'A recover email has been failed sent.';
            }
        }

        return view('blog.user-recover',[]);
    }


    public function recoverActionProcess(){

        $token = explode('/',$_SERVER["REQUEST_URI"])[2];


        return view('blog.user-recover-process',['token'=>$token]);
    }


    public function recoverActionChangePasswordSubmit(){


        if($_POST["password"]==$_POST["confirmpassword"]){
            $token = $_POST["token"];
            $password =  sha1($_POST["password"]);
            if($query = mysqli_query($this->RawConnect,"update user set password = '{$password}'  where salt = '{$token}' ")){
                $_SESSION["PasswordRecover"] = "Your password has been recovered.Please login now.";
                header("Location: /login");
            }

        }

        //return view('blog.user-recover-process',[]);
    }


}