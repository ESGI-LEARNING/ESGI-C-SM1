<?php

namespace App\Controllers\Auth;

use App\Form\Auth\ForgottenPasswordType;
use App\Form\Auth\ResetPasswordType;
use App\Mails\AuthMail;
use App\Models\ResetPassword;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\Views\View;

class ForgotPasswordController extends AbstractController
{
    public function forgotPassword(): View
    {
        $form = new ForgottenPasswordType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $user  = User::findBy(['email' => $form->get('email')]);
            $token = $this->setToken($user->getId());

            $mailer = new AuthMail();
            $mailer->sendResetPassword($form->get('email'), [
                'username' => $user->getUsername(),
                'token'    => $token,
                'token'    => $token,
            ]);

            $this->addFlash('success', 'Un email vous a été envoyé pour réinitialiser votre mot de passe');
            $this->redirect('/login');
        }

        return $this->render('security/forgottenPassword', 'front', [
            'form' => $form->getConfig(),
        ]);
    }

    public function resetPassword(string $token): View
    {
        $resetPassword = ResetPassword::findBy(['token' => $token]);
        $form          = new ResetPasswordType();
        $form->handleRequest();

        if ($resetPassword->getExpiredAt() < date('Y-m-d H:i:s')) {
            $this->addFlash('error', 'Token expiré');
            $this->redirect('/login');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user = $user->find($resetPassword->getUserId());
            $user->setPassword($form->get('password'));
            $user->save();

            $resetPassword->delete();

            $this->addFlash('success', 'Votre mot de passe a bien été modifié');
            $this->redirect('/login');
        }

        return $this->render('security/resetPassword', 'front', [
            'form' => $form->getConfig(),
        ]);
    }

    private function setToken(string $id): string
    {
        $token = bin2hex(random_bytes(32));

        $resetPassword = new ResetPassword();
        $resetPassword->setToken($token);
        $resetPassword->setUserId($id);
        $resetPassword->setExpiredAt(date('Y-m-d H:i:s', strtotime('+1 hour')));
        $resetPassword->save();

        return $token;
    }
}
