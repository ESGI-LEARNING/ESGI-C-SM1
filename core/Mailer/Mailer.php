<?php

namespace Core\Mailer;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{

    private string $message;

    public function send(string $to, string $subject, string $templateHtml, string $templateText, array $data = []): void
    {
        $mailer = new PHPMailer(true);

        try {
            $mailer->isSMTP();
            $mailer->CharSet = 'UTF-8';

            // config for prod environment
            if (config('app.env') === 'prod') {
                $mailer->Host       = config('mail.host');
                $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailer->Port       = intval(config('mail.port'), 10) ?? 587;
                $mailer->SMTPAuth   = true;
                $mailer->Username   = config('mail.username');
                $mailer->Password   = config('mail.password');
            }

            // config for dev environment
            if (config('app.env') === 'dev') {
                $mailer->SMTPAuth = false;
                $mailer->Host     = config('mail.host');
                $mailer->Port     =  1025;
            }

            // recipes
            $mailer->setFrom(config('mail.from-address'), config('mail.from-name'));
            $mailer->addAddress($to);

            // Add template
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body    = $this->getTemplateHtml($templateHtml, $data);
            $mailer->AltBody = $this->getTemplateTxt($templateText, $data);

            // Send mails
            $mailer->send();
        } catch (Exception $e) {
            $this->message =  $mailer->ErrorInfo;
        }
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    private function getTemplateHtml(string $template, array $data): string
    {
        extract($data);

        $templatePath = '../views/mails/'.$template.'.html.php';
        if (!file_exists($templatePath)) {
            exit('Le template '.$template.' n\'existe pas');
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

    private function getTemplateTxt(string $template, array $data): string
    {
        extract($data);

        $templatePath = '../views/mails/'.$template.'.txt.php';
        if (!file_exists($templatePath)) {
            exit('Le template '.$template.' n\'existe pas');
        }

        ob_start();
        include $templatePath;
        $templateTxt = ob_get_clean();

        return $templateTxt;
    }
}
