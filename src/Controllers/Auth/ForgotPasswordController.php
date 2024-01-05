<?php

namespace App\Controllers\Auth;

use App\Form\Auth\ForgottenPasswordType;
use App\Form\Auth\ResetPasswordType;
use App\Models\ResetPassword;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\Mailer\Mailer;
use Core\Views\View;

class ForgotPasswordController extends AbstractController
{
    public function forgotPassword(): View
    {
        $form = new ForgottenPasswordType();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $mailer = new Mailer();
            $mailer->send(
                $data['email'],
                'reset password',
                'auth.resetPassword',
                ''
            );

            $this->redirect('/login');
        }

        return $this->render('security/forgottenPassword', 'front', [
            'config' => $form->getConfig(),
        ]);
    }

    public function resetPassword(string $token): View
    {
        $form = new ResetPasswordType();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $resetPassword = new ResetPassword();
            $resetPassword = $resetPassword->getOneBy(['token' => $token,], 'object');

            if ($resetPassword) {
                $user = $resetPassword->getUser();
                $user->setPassword($data['password']);
                $user->save();

                $resetPassword->delete();

                $this->addFlash('success', 'Votre mot de passe a bien été modifié');
                $this->redirect('/login');
            } else {
                $this->addFlash('error', 'Token invalide');
            }
        }

        return $this->render('security/resetPassword', 'front', [
            'config' => $form->getConfig(),
        ]);
    }

    private function setToken(string $email): string
    {
        $token = bin2hex(random_bytes(60));

        $user = new User();
        $user->getOneBy(['email' => $email]);

        $resetPassword = new ResetPassword();
        $resetPassword->setToken($token);
        $resetPassword->setUser($user);
        $resetPassword->save();

        return $token;
    }
}