<?php

namespace Core\Mailer;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public function send(string $to, string $subject, string $templateHtml, string $templateText, array $data = []): void
    {
        $mailer = new PHPMailer(true);

        try {
            $mailer->isSMTP();
            $mailer->CharSet = "UTF-8";

            //config for prod environment
            if (config('app.env') === 'prod') {
                $mailer->Host = config('mail.host');
                $mailer->SMTPAuth = true;
                $mailer->Username = config('mail.username');
                $mailer->Password = config('mail.password');
                $mailer->SMTPSecure = config('mail.encryption') ?? PHPMailer::ENCRYPTION_SMTPS;
                $mailer->Port = config('mail.port');
            }

            $mailer->SMTPAuth = false;
            $mailer->Host = config('mail.host');
            $mailer->Port = config('mail.port');

            //recipes
            $mailer->setFrom(config('mail.from-address'), config('mail.from-name'));
            $mailer->addAddress($to);

            //Add template
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body = $this->getTemplateHtml($templateHtml, $data);
            $mailer->AltBody = 'toto';

            //Send mails
            $mailer->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        }
    }

    private function getTemplateHtml(string $template, array $data): string
    {
        extract($data);

        $templatePath = '../views/mails/' . $template . '.html.php';
        if (!file_exists($templatePath)) {
            exit('Le template ' . $template . ' n\'existe pas');
        }

        ob_start();
        include $templatePath;
        $templateHtml = ob_get_clean();

        $layoutPath = '../views/mails/layouts/index.html.php';
        if (!file_exists($layoutPath)) {
            exit('Le layout n\' existe pas');
        }

        ob_start();
        include $layoutPath;
        $content = ob_get_clean();

        return str_replace('{{ content }}', $templateHtml, $content);
    }
}