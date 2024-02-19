<?php

namespace App\Controllers\Admin;

use App\Form\Admin\User\AdminUserCreateType;
use App\Form\Admin\User\AdminUserEditType;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\Views\View;

class AdminUserController extends AbstractController
{
    public function index(): View
    {
        return $this->render('admin/users/index', 'back', [
            'users' => User::findAll(),
        ]);
    }

    public function create(): View
    {
        $form = new AdminUserCreateType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user->setUsername($form->get('username'));
            $user->setEmail($form->get('email'));
            $user->setPassword($form->get('password'));
            $user->save();

            $user->roles()->sync($form->get('roles'));

            $this->addFlash('success', 'L\'utilisateur a bien été créé');
            $this->redirect('/admin/users');
        }

        return $this->render('admin/users/create', 'back', [
            'form' => $form->getConfig(),
        ]);
    }

    public function edit(int $id): View
    {
        $user = User::query()
            ->with(['roles'])
            ->getOneBy(['id' => $id]);

        $form = new AdminUserEditType($user);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($form->get('username'));
            $user->setEmail($form->get('email'));
            $user->setUpdatedAt(date('Y-m-d H:i:s'));
            $user->save();

            $user->roles()->sync($form->get('roles'));

            $this->addFlash('success', 'L\'utilisateur a bien été modifié');
            $this->redirect('/admin/users');
        }

        return $this->render('admin/users/edit', 'back', [
            'user' => $user,
            'form' => $form->getConfig(),
        ]);
    }

    public function delete(int $id): void
    {
        $user = User::find($id);

        if ($user) {
            if ($this->verifyCsrfToken()) {
                $user->setIsDeleted(1);
                $user->save();

                $this->addFlash('success', 'L\'utilisateur a bien été supprimé');
                $this->redirect('/admin/users');
            }
        }
    }
}
