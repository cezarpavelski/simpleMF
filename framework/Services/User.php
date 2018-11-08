<?php

namespace Framework\Services;

use Framework\Mail\Mailer;
use Framework\Entities\User as UserEntity;
use Framework\Auth\AuthenticatorSession;
use Framework\Session\Store as Session;
use Framework\Exceptions\AuthenticationException;
use Framework\FileSystem\File as FileSystem;

class User
{

    public function login(string $email, string $password): \stdClass
    {
        $user = AuthenticatorSession::authenticate($email, $password);

        return $user;

    }

    public function list(): array
    {
        $user = new UserEntity();
        return $user->findAll();
    }

    public function import(): array
    {
        $filePath = FileSystem::upload($_FILES, 'file_import_'.strtotime('now').'.csv');
        if (($handle = fopen($filePath, "r")) !== FALSE) {
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
