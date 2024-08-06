<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Server settings
        $this->mail->SMTPDebug = 0;                       // Enable verbose debug output
        $this->mail->isSMTP();                            // Set mailer to use SMTP
        $this->mail->Host       = env('MAIL_HOST');       // Specify main and backup SMTP servers
        $this->mail->SMTPAuth   = true;                   // Enable SMTP authentication
        $this->mail->Username   = env('MAIL_USERNAME');   // SMTP username
        $this->mail->Password   = env('MAIL_PASSWORD');   // SMTP password
        $this->mail->SMTPSecure = env('MAIL_ENCRYPTION'); // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port       = env('MAIL_PORT');       // TCP port to connect to
        $this->mail->CharSet    = 'UTF-8';
    }

    public function sendEmail($to, $subject, $body, $from = null, $fromName = null)
    {
        try {
            // Recipients
            $this->mail->setFrom($from ?? env('MAIL_FROM_ADDRESS'), $fromName ?? env('MAIL_FROM_NAME'));
            $this->mail->addAddress($to);

            // Content
            $this->mail->isHTML(true);                    // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}