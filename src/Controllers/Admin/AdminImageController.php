<?php

namespace App\Controllers\Admin;

use App\Form\Admin\AdminImageCreateType;
use App\Form\Admin\AdminImageEditType;
use App\Models\Picture;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\Views\View;

class AdminImageController extends AbstractController
{
    public function index(): View
    {
        return $this->render('admin/images/index', 'back', [
            'images' => Picture::findAll(),
        ]);
    }

    public function create(): View
    {
        $form = new AdminImageCreateType();

        if ($form->isSubmitted() && $form->isValid()) {
            $data  = $form->getData();
            $image = new Picture();

            $image->setName($data['objet']);
            $image->setSlug($data['slug']);
            $image->setDescription($data['description']);
            $image->setImage($data['image']);
            $image->setUserId(1);

            $image->save();

            $this->addFlash('success', 'L\'utilisateur a bien été créé');
            $this->redirect('/admin/images');
        }

        return $this->render('admin/images/create', 'back', [
            'form' => $form->getConfig(),
        ]);
    }

    public function edit(int $id): View
    {
        $user =  Picture::find($id);

        $form  = new AdminImageEditType($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setUpdatedAt(date('Y-m-d H:i:s'));
            $user->save();

            $this->addFlash('success', 'L\'utilisateur a bien été modifié');
            $this->redirect('/admin/images');
        }

        return $this->render('admin/images/edit', 'back', [
            'user' => $user,
            'form' => $form->getConfig(),
        ]);
    }

    public function delete(int $id): void
    {
        $user = User::find($id);

        if ($user) {
            $user->setIsDeleted(1);
            $user->save();

            $this->addFlash('success', 'L\'utilisateur a bien été supprimé');
            $this->redirect('/admin/images');
        }
    }
}
