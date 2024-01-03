<?php

namespace App\Controllers\Auth;

use App\Form\Auth\LoginType;
use App\Form\Auth\RegisterType;
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

            $user = new User();
            $user = $user->getOneBy([
                'email' => $data['email'],
            ], 'object');

            if ($user && password_verify($data['password'], $user->getPassword())) {
                $authenticator = new Authenticator();
                $authenticator->login($user);

                $this->addFlash('success', 'Vous êtes connecté');
                $this->redirect('login');
            } else {
                $this->addFlash('error','Identifiants ou mot de passe incorrects');
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
    }
}
