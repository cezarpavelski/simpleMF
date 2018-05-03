<?php

namespace Framework\Services;

use PHPMailer\PHPMailer\PHPMailer;
use Framework\Mail\Mailer;
use Framework\Entities\User as UserEntity;
use Framework\Auth\Authenticator;
use Framework\Facades\Request;
use Framework\Session\Store as Session;
use Framework\Exceptions\AuthenticationException;
use StdClass;

class User
{

    public function login(): ?StdClass
    {
        $email = Request::post('email');
        $password = $this->cryptPassword(Request::post('password'));
        $user = Authenticator::authenticate($email, $password);

        if(!empty($user)){
            Session::set('user', json_encode($user[0]));
            return $user[0];
        }
        throw new AuthenticationException("User not found", 1);
    }

    public function list(): array
    {
        $user = new UserEntity();
        return $user->findAll();
    }

    public function import(): array
    {
        $fileName = 'file_import_'.strtotime('now').'.csv';
        move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__."/../../storage/reports/".$fileName);
        if (($handle = fopen(__DIR__."/../../storage/reports/".$fileName, "r")) !== FALSE) {
            $flag = false;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (!empty($flag)) {
                    $user = new UserEntity(NULL, $data[0], $data[1], $data[2], $data[3]);
                    $user->insert();
                }
                $flag = true;
            }
        }
        fclose($handle);
        $user = new UserEntity();
        return $user->findAll();
    }

    public function validateSession(): bool
    {
        if(Session::get('user')){
            return true;
        }
        throw new AuthenticationException("Session expired", 1);
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

    private function cryptPassword(string $password): string
    {
        return hash('sha256', getenv('APP_KEY').$password);
    }

}
