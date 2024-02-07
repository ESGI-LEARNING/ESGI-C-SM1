<?php

namespace App\Controllers;

use App\Form\Profil\ProfileAuthorEditType;
use App\Form\Profil\ProfileEditType;
use App\Models\InformationPhotograph;
use App\Service\UploadFile;
use Core\Auth\Auth;
use Core\Controller\AbstractController;
use Core\Views\View;

class ProfileController extends AbstractController
{
    public function index(): View
    {
        $user        = Auth::user();
        $author      = new InformationPhotograph();
        $author      = $author::query()->getOneBy(['user_id' => Auth::id()]);
        $formProfile = new ProfileEditType();
        $formAuthor  = new ProfileAuthorEditType();

        return $this->render('profile/index', 'front', [
            'user'        => $user,
            'author'      => $author,
            'formProfile' => $formProfile->getConfig(),
            'formAuthor'  => $formAuthor->getConfig(),
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
            $user->setUpdatedAt(date('Y-m-d H:i:s'));
            $user->save();
            $this->addFlash('success', 'L\'utilisateur a bien été modifié');
            $this->redirect('/profile');
        }
    }

    public function editAuthor(): void
    {
        $author = new InformationPhotograph();
        $form   = new ProfileAuthorEditType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $author->setId(Auth::author()->getId());
            $author->setUserId(Auth::id());
            $author->setFirstName($form->get('firstName'));
            $author->setLastName($form->get('lastName'));
            $author->setDescription($form->get('description'));
            $author->setCity($form->get('city'));
            $author->setCountry($form->get('country'));
            $author->save();

            $this->addFlash('success', 'Le profil photographe a bien été modifié');
            $this->redirect('/profile');
        }
    }

    public function softDelete(): void
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
            $this->addFlash('success', 'L\'utilisateur a bien été supprimé');
            $this->redirect('/logout');
        }
        $this->redirect('/logout');
    }

    public function updateAvatar(): string
    {
        if (isset($_FILES['avatar'])) {
            $path = UploadFile::uploadImageProfile($_FILES['avatar'], Auth::id());

            return json_encode(['path' => $path]);
        }

        return json_encode(['error' => 'No file uploaded']);
    }
}
