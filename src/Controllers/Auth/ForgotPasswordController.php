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

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user  = User::findBy(['email' => $data['email']]);
            $token = $this->setToken($user->getId());

            $mailer = new AuthMail();
            $mailer->sendResetPassword($data['email'], [
                'username' => $user->getUsername(),
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
        $form          = new ResetPasswordType();
        $resetPassword = ResetPassword::findBy(['token' => $token]);

        if ($resetPassword->getExpiredAt() < date('Y-m-d H:i:s')) {
            $this->addFlash('error', 'Token expiré');
            $this->redirect('/login');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = new User();
            $user = $user->find($resetPassword->getUserId());
            $user->setPassword($data['password']);
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
