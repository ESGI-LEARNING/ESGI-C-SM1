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

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = User::findBy(['email' => $data['email']]);

            if ($user && password_verify($data['password'], $user->getPassword())) {
                $authenticator = new Authenticator();
                $authenticator->login($user);

                $this->addFlash('success', 'Vous êtes bien connecté');
                $this->redirect('/');
            } else {
                $this->addFlash('error','Identifiants ou mot de passe incorrects');
                $this->redirect('/login');
            }
        }

        return $this->render('security/login', 'front', [
            'config' => $form->getConfig(),
        ]);
    }

    public function register(): View
    {
        $form = new RegisterType();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->save();

            //Send mails for verify email
            $mailer = new AuthMail();
            $mailer->sendVerifyEmail($data['email'], [
                'username' => $data['username'],
            ]);

            $this->addFlash('success', 'Votre compte a bien été créé');
            $this->redirect('/login');
        }

        return $this->render('security/register', 'front', [
            'config' => $form->getConfig(),
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
