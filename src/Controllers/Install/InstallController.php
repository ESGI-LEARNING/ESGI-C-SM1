<?php

namespace App\Controllers\Install;

use App\Form\Install\DbType;
use App\Form\Install\SmtpType;
use Core\Controller\AbstractController;
use Core\DB\DB;
use Core\DB\Migration\MigrationService;
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

        if ($form->isSubmitted() && $form->isValid()) {
            $this->setEnv('MAIL_HOST', $form->get('host'));
            $this->setEnv('MAIL_PORT', $form->get('port'));
            $this->setEnv('MAIL_USERNAME', $form->get('user'));
            $this->setEnv('MAIL_PASSWORD', $form->get('password'));
            $this->setEnv('MAIL_FROM_ADDRESS', $form->get('email'));
            $this->setEnv('MAIL_FROM_NAME', $form->get('name'));

            $this->addFlash('success', 'SMTP configuré avec success');
        }

        return $this->render('install/smtp_installation', 'front', [
            'form' => $form->getConfig()
        ]);
    }

    public function adminUser(): View
    {
        return $this->render('install/create_admin_user', 'front');
    }
}