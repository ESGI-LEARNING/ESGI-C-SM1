<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Controller\AbstractController;

class VerifyEmailController extends AbstractController
{
    public function index(int $id, string $token): void
    {
        $user = User::findBy(['id' => $id]);

        if (!$user) {
            $this->addFlash('error', 'Utilisateur introuvable');
            $this->redirect('/login');
        }

        if ($user) {
            $url = config('app.url') . '/verify-email/' . $user->getEmail();

            if (hash_equals(hash('sha512', $url), $token)) {
                $user->setVerify(1);
                $user->save();

                $this->addFlash('success', 'Votre email a bien été vérifié');
                $this->redirect('/login');
            }
        } else {
            $this->addFlash('error', 'Votre email n\'a pas pu être vérifié');
            $this->redirect('/login');
        }
    }
}