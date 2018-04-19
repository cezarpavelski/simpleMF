<?php

namespace Framework\Services;

use PHPMailer\PHPMailer\PHPMailer;
use Framework\Mail\Mailer;
use Framework\Entities\User as UserEntity;

class User
{

    public function login(): bool
    {
        return true;
    }

    public function logout(): bool
    {
        return true;
    }

    public static function new(): bool
    {
        $password =  hash('sha256', getenv('APP_KEY').'123456');
        $user = new UserEntity(NULL, 'Cezar', 'cezarpavelski@gmail.com', $password, date('Y-m-d H:i:s'));
        return $user->insert();
    }

    public static function recoveryPassword($email): void
    {
        $mailer = new Mailer();
        $mailer->setFrom('noreply@gmail.com', 'No Reply');
        $mailer->setSubject('Recovery Password');
        $mailer->setBody('New password is <b>xxxxx</b>');
        $mailer->addAddress($email, 'Email Destinatario');
        $mailer->addAttachment(__DIR__.'/../Mail/logo.png', 'Logo');
        try {
            $mailer->send();
            echo 'Message sent';
        } catch (MailException $e) {
            echo $e->getMessage();exit;
        }
    }

}
