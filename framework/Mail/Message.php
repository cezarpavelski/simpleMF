<?php

namespace Framework\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class Message
{
    protected $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
        $this->mailer->SMTPDebug = 0;
        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = true;
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->isHTML(true);
    }

    public function setUsername(string $username): void
    {
        $this->mailer->Username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->mailer->Password = $password;
    }

    public function setPort(string $port): void
    {
        $this->mailer->Port = $port;
    }

    public function setFrom(string $email, string $name): void
    {
        $this->mailer->setFrom($email, $name);
    }

    public function addAddress(string $email, string $name): void
    {
        $this->mailer->addAddress($email, $name);
    }

    public function addCC(string $email, string $name): void
    {
        $this->mailer->addCC($email, $name);
    }

    public function addBCC(string $email, string $name): void
    {
        $this->mailer->addBCC($email, $name);
    }

    public function addAttachment(string $path_archive, string $name_archive): void
    {
        $this->mailer->addAttachment($path_archive, $name_archive);
    }

    public function setSubject(string $subject): void
    {
        $this->mailer->Subject = $subject;
    }

    /*
    This is the body in plain text for non-HTML mail clients
     */
    public function setAltBody(string $alt_body): void
    {
        $this->mailer->AltBody = $alt_body;
    }

    public function setBody(string $body): void
    {
        $this->mailer->Body = $body;
    }

}
