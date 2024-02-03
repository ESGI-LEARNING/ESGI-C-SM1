<?php

namespace App\Controllers\Auth;

use App\Form\Auth\LoginType;
use App\Form\Auth\RegisterType;
use App\Mails\AuthMail;
use App\Models\User;
use Core\Auth\Authenticator;
use Core\Controller\AbstractController;
use Core\Views\View;

class SecurityController extends AbstractController
{
    public function login(): View
    {
        $form = new LoginType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $user = User::findBy(['email' => $form->get('email')]);

            if ($user && password_verify($form->get('password'), $user->getPassword())) {
                $authenticator = new Authenticator();
                $authenticator->login($user);

                $this->addFlash('success', 'Vous êtes bien connecté');
                $this->redirect('/');
            } else {
                $this->addFlash('error', 'Identifiants ou mot de passe incorrects');
                $this->redirect('/login');
            }
        }

        return $this->render('security/login', 'front', [
            'form' => $form->getConfig(),
        ]);
    }

    public function register(): View
    {
        $form = new RegisterType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user->setUsername($form->get('username'));
            $user->setEmail($form->get('email'));
            $user->setPassword($form->get('password'));
            $user->save();

            // Set role user for default user
            $user->roles()->sync([2]);

            // Send mails for verify email
            $mailer = new AuthMail();
            $mailer->sendVerifyEmail($form->get('email'), [
                'username' => $form->get('username'),
            ]);

            $this->addFlash('success', 'Votre compte a bien été créé');
            $this->redirect('/login');
        }

        return $this->render('security/register', 'front', [
            'form' => $form->getConfig(),
        ]);
    }

    public function logout(): void
    {
        $newSession = new Authenticator();
        $newSession->logout();

        $this->addFlash('success', 'Vous êtes bien déconnecté');
        $this->redirect('/');
    }
}
