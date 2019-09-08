<?php

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer{

    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->setup();
    }

    public function setup()
    {
        $env = getenv('APP_ENV');
        if($env === 'local'){
            $this->mail->SMTPDebug = '';
        }
        $this->mail->isSMTP();
        $this->mail->Mailer = 'smtp';
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Host = getenv('SMTP_HOST');
        $this->mail->Port = getenv('SMTP_PORT');


        $this->mail->Username = getenv('MAIL_USERNAME');
        $this->mail->Password = getenv('MAIL_PASSWORD');

        $this->mail->isHTML(true);
        $this->mail->SingleTo = true;

        $this->mail->From = getenv('Admin_EMAIL');

    }

    public function send($data = []){
        $this->mail->setFrom(getenv('MAIL_setFrom'), getenv('MAIL_setFromNAME'));
        $this->mail->addAddress($data['to'],$data['name']);
        $this->mail->Subject = $data['subject'];
        $this->mail->Body = makemail($data['view'],['data'=>$data['body']]);

        return $this->mail->send();

    }


}