<?php

namespace App\Controllers\Admin;

use App\Form\Admin\Category\AdminCategoryType;
use App\Models\Category;
use Core\Controller\AbstractController;
use Core\Router\Request;
use Core\Views\View;

class AdminCategoryController extends AbstractController
{
    public function index(): View
    {
        $categories = Category::findAll();

        return $this->render('admin/categories/index', 'back', [
            'categories' => $categories
        ]);
    }

    public function create(): View
    {
        $category = new Category();
        $form = new AdminCategoryType($category);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setName($form->get('name'));
            $category->setSlug(slug($form->get('name')));
            $category->save();

            $this->addFlash('success', 'La category à bien été créé');
            $this->redirect('/admin/categories');
        }

        return $this->render('admin/categories/create', 'back', [
            'form' => $form->getConfig()
        ]);
    }

    public function edit(int $id): View
    {
        $category = Category::find($id);
        $form = new AdminCategoryType($category);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setName($form->get('name'));
            $category->setSlug(slug($form->get('name')));
            $category->setUpdatedAt(date('Y-m-d H:i:s'));
            $category->save();

            $this->addFlash('success', 'L\'utilisateur a bien été modifié');
            $this->redirect('/admin/categories');
        }

        return $this->render('admin/categories/edit', 'back', [
            'form' => $form->getConfig(),
            'category' => $category
        ]);
    }

    public function delete(int $id): void
    {
        $category = Category::find($id);

        if ($category) {
            $category->setIsdeleted(1);
            $category->save();
        }

        $this->addFlash('success', 'la catégory à bien été supprimer');
        $this->redirect('/admin/categories');
    }
}