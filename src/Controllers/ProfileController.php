<?php

namespace App\Controllers;

use App\Form\Auth\ResetPasswordType;
use App\Form\Profil\ProfileAuthorEditType;
use App\Form\Profil\ProfileEditType;
use App\Models\InformationPhotograph;
use App\Models\User;
use App\Service\UploadFile;
use Core\Auth\Auth;
use Core\Controller\AbstractController;
use Core\Router\Request;
use Core\Views\View;

class ProfileController extends AbstractController
{
    public function index(): View
    {
        $user              = Auth::user();
        $author            = InformationPhotograph::query()->getOneBy(['user_id' => Auth::id()]);

        if ($author === null) {
            $author = new InformationPhotograph();
        }
        $formProfile       = new ProfileEditType($user);
        $formResetPassword = new ResetPasswordType();

        return $this->render('profile/index', 'profile', [
            'user'              => $user,
            'author'            => $author,
            'formProfile'       => $formProfile->getConfig(),
            'formResetPassword' => $formResetPassword->getConfig(),
        ]);
    }

    public function author(): View
    {
        $user              = Auth::user();
        $author            = InformationPhotograph::query()->getOneBy(['user_id' => Auth::id()]);

        if ($author === false) {
            $author            = new InformationPhotograph();
            $formAuthor        = new ProfileAuthorEditType();
        } else {
            $formAuthor        = new ProfileAuthorEditType($author);
        }

        $formResetPassword = new ResetPasswordType();

        return $this->render('profile/index', 'profile', [
            'user'              => $user,
            'author'            => $author,
            'formAuthor'        => $formAuthor->getConfig(),
            'formResetPassword' => $formResetPassword->getConfig(),
        ]);
    }

    public function password(): View
    {
        $user              = Auth::user();
        $formResetPassword = new ResetPasswordType();

        return $this->render('profile/index', 'profile', [
            'user'              => $user,
            'formResetPassword' => $formResetPassword->getConfig(),
        ]);
    }

    public function edit(): void
    {
        $user = Auth::user();
        $form = new ProfileEditType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($form->get('username'));
            $user->setEmail($form->get('email'));
            $user->setUpdatedAt();
            $user->save();

            $this->addFlash('success', 'L\'utilisateur a bien été modifié');
            $this->redirect('/profile');
        }
    }

    public function editAuthor(): void
    {
        $form              = new ProfileAuthorEditType();
        $author            = InformationPhotograph::query()->getOneBy(['user_id' => Auth::id()]);
        if ($author === false) {
            $author = new InformationPhotograph();
        }
        $form->handleRequest();
        if ($form->isSubmitted() && $form->isValid()) {
            $author->setUserId(Auth::id());
            $author->setFirstName($form->get('firstName'));
            $author->setLastName($form->get('lastName'));
            $author->setDescription($form->get('description'));
            $author->setCity($form->get('city'));
            $author->setCountry($form->get('country'));
            $author->setUpdatedAt();
            $author->save();

            $this->addFlash('success', 'Le profil photographe a bien été modifié');
            $this->redirect('/profile');
        }
    }

    public function delete(): void
    {
        $user = Auth::user();

        if (Auth::id()) {
            $user->softDelete();
            $this->addFlash('success', 'L\'utilisateur a bien été supprimé');
            $this->redirect('/logout');
        }

        $this->redirect('/logout');
    }

    public function hardDelete(): void
    {
        $user = Auth::user();

        if (Auth::id()) {
            $user->hardDelete();
            $this->addFlash('success', 'L\'utilisateur a bien été supprimé définitivement');
            $this->redirect('/logout');
        }

        $this->redirect('/logout');
    }

    public function updateAvatar(): string
    {
        $request = new Request();
        if ($request->file('avatar') !== null) {
            $path = UploadFile::uploadImageProfile($request->file('avatar'), Auth::id());

            return json_encode(['path' => $path]);
        }

        return json_encode(['error' => 'No file uploaded']);
    }

    public function resetPassword(): void
    {
        $form          = new ResetPasswordType();
        $form->handleRequest();
        $user = new User();
        $user = $user::query()->getOneBy(['id' => Auth::id()]);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($form->get('password'));
            $user->setUpdatedAt();
            $user->save();

            $this->addFlash('success', 'Votre mot de passe a bien été modifié');
            $this->redirect('/profile');
        }
    }
}
