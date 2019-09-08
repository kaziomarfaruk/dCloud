<?php

if(!isset($_SESSION))session_start();

require_once __DIR__.'/../app/config/_env.php';

new \App\Classes\IlluminateDatabase();


$RawDB = new \App\Classes\RawDatabase();
$RawConnect = $RawDB->getConnection();

//var_dump($RawConnect);
/*
$mailer = new App\Classes\Mailer();
$data = [
    'to' =>         'dipsgalaxy01@gmail.com',
    'subject' =>    'testing php mailer email',
    'view' =>       'welcome',
    'name' =>       'KD',
    'body' =>       'testing mail'
];

if($mailer->send($data)){
    echo 'mail has been sent';
}else{
    echo 'mail sent failed';
}

*/

set_error_handler([new \App\Classes\ErrorHandler(),'handleErrors']); // [class name,method to be called]

require_once __DIR__.'/../app/routing/route.php';
new \App\RouteDispatcher($router);

















