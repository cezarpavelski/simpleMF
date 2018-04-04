<?php

namespace Framework\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use Framework\Mail\Message;
use Framework\Exceptions\MailException;

class Mailer extends Message
{
    protected $mailer;

    public function __construct()
    {
        parent::__construct(new PHPMailer(true));
        $this->setUsername(getenv('MAIL_USERNAME'));
        $this->setPassword(getenv('MAIL_PASSWORD'));
        $this->setPort(getenv('MAIL_PORT'));
    }

    public function send(): bool
    {
        if (!$this->mailer->send()) {
            throw new MailException("Mailer Error: " . $this->mailer->ErrorInfo, 1);
        }
        return true;
    }

}
