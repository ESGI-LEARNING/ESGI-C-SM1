<?php

namespace App\Controllers\Admin;

use App\Form\Article\AdminArticleCreateType;
use App\Form\Article\AdminArticleEditType;
use App\Models\Category;
use App\Models\Picture;
use Core\Controller\AbstractController;
use Core\Views\View;

class AdminArticleController extends AbstractController
{
    public function index(): View
    {
        $articles = Picture::findAll();

        return $this->render('admin/articles/index', 'back', [
            'articles' => $articles,
        ]);
    }

    public function create(): View
    {
        $form = new AdminArticleCreateType();
        if ($form->isSubmitted() && $form->isValid()) {
            $form->handleRequest();
            $article = new Picture();
            $article->setName($form->get('name'));
            $article->setSlug(trim($form->get('name')));
            $article->setDescription($form->get('description'));
            $article->setUserId($this->getUser()->getId());
            $article->setImage($form->get('image'));
            $article->setCreatedAt(date('Y-m-d H:i:s'));
            $article->save();

            $this->addFlash('success', 'L\'article a bien été créé');
            $this->redirect('/admin/articles');
        }

        return $this->render('admin/articles/create', 'back', [
            'form' => $form->getConfig(),
        ]);
    }

    public function edit($id)
    {
        $article    = Picture::find($id);
        $form       = new AdminArticleEditType($article);
        $categories = Category::findAll();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setName($form->get('name'));
            $article->setDescription($form->get('description'));
            $article->setImage($form->get('image'));
            $article->setUserId($this->getUser()->getId());
            $article->setUpdatedAt(date('Y-m-d H:i:s'));
            $article->save();

            $this->addFlash('success', 'L\'article a bien été modifié');
            $this->redirect('/admin/articles');
        }

        return $this->render('admin/articles/edit', 'back', [
            'form'    => $form->getConfig(),
            'article' => $article,
            'options' => $categories,
        ]);
    }

    public function delete($id)
    {
        $article = Picture::find($id);

        if ($article) {
            $article->setIsDeleted(1);
            $article->save();

            $this->addFlash('success', 'L\'article a bien été supprimé');
            $this->redirect('/admin/articles');
        }
    }
}
