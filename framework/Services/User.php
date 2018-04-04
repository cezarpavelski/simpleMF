<?php

namespace Framework\Services;

use PHPMailer\PHPMailer\PHPMailer;
use Framework\Mail\Mailer;

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

    public function recoveryPassword(): void
    {
        $mailer = new Mailer();
        $mailer->setFrom('noreply@gmail.com', 'No Reply');
        $mailer->setSubject('Recovery Password');
        $mailer->setBody('New password is <b>xxxxx</b>');
        $mailer->addAddress('cezarpavelski@gmail.com', 'Cezar');
        $mailer->addAttachment(__DIR__.'/../Mail/logo.png', 'Logo');
        try {
            $mailer->send();
            echo 'Message sent';
        } catch (MailException $e) {
            echo $e->getMessage();exit;
        }
    }

}
