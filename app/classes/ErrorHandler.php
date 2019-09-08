<?php
/**
 * Created by PhpStorm.
 * User: dips1337x
 * Date: 01/12/2018
 * Time: 13:57
 */

namespace App\Classes;


class ErrorHandler
{
    public function handleErrors($error_number,$error_message,$error_file,$error_line){
        $error = "[{$error_number}] occurred in file {$error_file} on line {$error_line} : {$error_message}";
        $env = getenv('APP_ENV');
        if($env === 'local'){
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }else{
            $data  = [
              'to' => getenv('Admin_EMAIL'),
              'subject' => 'System Error Message',
              'view' => 'errors',
              'name' => 'Admin',
              'body' => $error
            ];
            //object
            /*
             $adminEmail = new ErrorHandler();
             $adminEmail->emailAdmin($data)->outputFriendlyError();
            */
            //static method implement
            ErrorHandler::emailAdmin($data)->outputFriendlyError();
        }
    }

    public function outputFriendlyError(){
        ob_end_clean();
        view('errors/generic');
        exit;
    }

    /* for static object */
    public static function emailAdmin($data){
        $mail = new Mailer();
        $mail->send($data);
        return new static;
    }
    /* non static object
    public function emailAdmin($data){
        $mail = new Mailer();
        $mail->send($data);
        return $this;
    }
    */

}