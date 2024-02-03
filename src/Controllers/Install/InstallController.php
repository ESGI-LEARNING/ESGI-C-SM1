<?php

namespace App\Controllers\Install;

use App\Form\Install\AdminUserType;
use App\Form\Install\DbType;
use App\Form\Install\SmtpType;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\DB\DB;
use Core\DB\Migration\MigrationService;
use Core\Mailer\Mailer;
use Core\Views\View;

class InstallController extends AbstractController
{
    public function index(): View
    {
        return $this->render('install/index', 'front');
    }

    public function db(): View
    {
        $form = new DbType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->setEnv('DB_HOST', $form->get('host'));
            $this->setEnv('DB_DATABASE', $form->get('name'));
            $this->setEnv('DB_USERNAME', $form->get('username'));
            $this->setEnv('DB_PASSWORD', $form->get('password'));
            $this->setEnv('DB_PREFIX', $form->get('prefix'));

            $db = new DB();
            if ($db->getError() === null) {
                $migration = new MigrationService();
                $migration->createDb();

                $this->addFlash('success', 'Database configuré avec success');
                $this->redirect('/install/smtp');
            } else {
                $this->addFlash('error', $db->getError());
                $this->redirect('/install/db');
            }
        }

        return $this->render('install/db_installation', 'front', [
            'form' => $form->getConfig()
        ]);
    }

    public function smtp(): View
    {
        $form = new SmtpType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->setEnv('MAIL_HOST', $form->get('host'));
            $this->setEnv('MAIL_PORT', $form->get('port'));
            $this->setEnv('MAIL_USERNAME', $form->get('username'));
            $this->setEnv('MAIL_PASSWORD', $form->get('password'));
            $this->setEnv('MAIL_FROM_ADDRESS', $form->get('from'));
            $this->setEnv('MAIL_FROM_NAME', $form->get('name'));

            $mailer = new Mailer();

            // on envoie le mail de verification
            $mailer->send(
                $form->get('email'),
                'Vérification de votre compte',
                'install/test-send',
                'install/test-send',
                ['email' => $form->get('email')]
            );

            if ($mailer->getMessage() === null) {
                $this->addFlash('success', 'SMTP configuré avec success');
                $this->redirect('/install/admin-user');
            } else {
                $this->addFlash('error', $mailer->getMessage());
                $this->redirect('/install/smtp');
            }

            $this->addFlash('success', 'SMTP configuré avec success');
        }

        return $this->render('install/smtp_installation', 'front', [
            'form' => $form->getConfig()
        ]);
    }

    public function adminUser(): View
    {
        $user = new User();
        $form = new AdminUserType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($form->get('username'));
            $user->setEmail($form->get('email'));
            $user->setPassword($form->get('password'));
            $user->setVerify(1);
            $user->save();

            $user->roles()->sync([1]);

            // set env install true
            $this->setEnv('APP_INSTALL', 'true');

            $this->addFlash('success', 'Admin créé avec success');
            $this->redirect('/login');
        }

        return $this->render('install/create_admin_user', 'front', [
            'form' => $form->getConfig()
        ]);
    }
}