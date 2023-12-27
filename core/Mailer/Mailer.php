<?php

namespace Core\Mailer;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public function send(string $to, string $subject, string $templateHtml, string $templateText): void
    {
        $mailer = new PHPMailer(true);

        try {
            //connexion SMTP
            $mailer->isSMTP();
            $mailer->Host = config('mail.host');
            $mailer->SMTPAuth = true;
            $mailer->Username = config('mail.username');
            $mailer->Password = config('mail.password');
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port = config('mail.port');

            //recipes
            $mailer->setFrom(config('mail.from-email'), config('mail.from-name'));
            $mailer->addAddress($to);

            //Add template
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body = $templateHtml;
            $mailer->AltBody = $templateText;

            //Send mail
            $mailer->send();

        } catch (\Exception $e) {
            echo $e;
        }
    }
}