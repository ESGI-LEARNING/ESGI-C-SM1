<?php

namespace App\Controllers\Admin;

use App\Form\Admin\page\AdminPageCreateType;
use App\Form\Admin\page\AdminPageEditType;
use App\Models\Page;
use Core\Controller\AbstractController;
use Core\Views\View;

class AdminPageController extends AbstractController
{
    public function index(): View
    {
        return $this->render('admin/pages/index', 'back', [
            'pages' => Page::findAll(),
        ]);
    }

    public function create(): View
    {
        $page = new Page();
        $form = new AdminPageCreateType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $page->setName($form->get('name'));
            $page->setSlug(slug($form->get('slug')));
            $page->setMetadescription($form->get('metadescription'));
            $page->setContent($form->get('content'));
            $page->setCreatedAt();
            $page->setUpdatedAt();
            $page->save();

            $this->addFlash('success', 'La page à bien été créé');
            $this->redirect('/admin/pages');
        }

        return $this->render('admin/pages/create', 'back', [
            'form' => $form->getConfig(),
        ]);
    }

    public function edit(int $id): View
    {
        $page = Page::find($id);
        $form = new AdminPageEditType($page);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $page->setTitle($form->get('title'));
            $page->setName($form->get('name'));
            $page->setMetadescription($form->get('metadescription'));
            $page->setContent($form->get('content'));
            $page->setUpdatedAt();
            $page->save();

            $this->addFlash('success', 'La page a bien été modifiée');
            $this->redirect('/admin/pages');
        }

        return $this->render('admin/pages/edit', 'back', [
            'form' => $form->getConfig(),
            'page' => $page,
        ]);
    }

    public function hidden(int $id): void
    {
        $page = Page::find($id);

        if ($page) {
            $page->setIsHidden($page->getIsHidden() == 1 ? 0 : 1);
            $page->setUpdatedAt();
            $page->save();

            $this->addFlash('success', 'La page a bien été modifiée');
            $this->redirect('/admin/pages');
        }
    }

    public function delete(int $id): void
    {
        $page = Page::find($id);

        if ($page) {
            if ($page->getIsDeleted() === 1) {
                $page->hardDelete();
            }

            $page->softDelete();

            $this->addFlash('success', 'L\'utilisateur a bien été supprimé');
            $this->redirect('/admin/pages');
        }
    }
}
