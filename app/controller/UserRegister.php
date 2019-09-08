<?php

namespace App\Controller;

use App\Classes\Mailer;

class UserRegister
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


    public function register(){

        $pack = '';
        if( $pack = explode('/',$_SERVER['REQUEST_URI'])[3] ){}

        return view('blog.register',['pack'=>$pack]);

    }


    public function action(){


        //$package = $_POST['package'];

        $username = filter_var($_POST["username"],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        $password = sha1($_POST["password"]);
        $confirm_password = sha1($_POST["confirm_password"]);

        $isExists = 0;

        $query = mysqli_query($this->RawConnect,"SELECT * FROM user ");

        while($rslt = mysqli_fetch_assoc($query)){
            if($rslt["email"]==$email){
                $isExists = 1;
                break;
            }
        }

        if($isExists == 1) {

            $_SESSION['UserAlreadyExists'] = 'User already exists.';
            return header("Location: /register");

            //return view('blog.register',['registerFailed' => 'User already exists']);
        }else{
            if($password == $confirm_password) {
                $token = md5($email);
                $query = mysqli_query($this->RawConnect,"insert into user(username,email,password,salt,is_verified) VALUES('{$username}','{$email}','{$password}','{$token}','{$token}')");

                $_SESSION['registerConfirmation'] = $token;

                $mailer = new Mailer();
                $data = [
                    'to' =>         $email,
                    'subject' =>    'dCloud.com signup confirmation',
                    'view' =>       'welcome',
                    'name' =>       $username,
                    'body' =>       'http://dcloud.com/register/confirmation/'.$token
                ];

                if($mailer->send($data)){
                    echo 'mail has been sent';
                }else{
                    echo 'mail sent failed';
                }

                $_SESSION['ConfirmationMailMSG'] = 'A confirmation email has been sent for confirmation.';

                return header("Location: /login");

                //return view('blog.register',['registerFailed' => 'A confirmation email has been sent for confirmation.']);
            }else{
                $_SESSION['PasswordDidnotMatched'] = 'Password did not matched.Please try correct password.';
                return header("Location: /register");
            }


        }

    }

    public function confirmation(){

        $token = explode('/',$_SERVER["REQUEST_URI"])[3];

        if(isset($_SESSION['registerConfirmation']) && $_SESSION['registerConfirmation'] == $token){
            //echo $token;
            $query = mysqli_query($this->RawConnect,"UPDATE user set is_verified = 1 where salt = '{$token}'");
            session_unset($_SESSION['registerConfirmation']);
            $_SESSION["RegisterConfirmationSuccess"] = "Your registration has been confirmed.Please login to continue.";
            header("Location: /login");
        }else{
            echo "Session expired.Please try again later.";
        }


    }


}