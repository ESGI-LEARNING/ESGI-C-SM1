<?php

namespace App\Controllers\Admin;

use App\Form\Article\AdminArticleCreateType;
use App\Form\Article\AdminArticleEditType;
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
            $data    = $form->getData();
            $article = new Picture();
            $article->setName($data['name']);
            $article->setSlug(trim($data['name']));
            $article->setDescription($data['description']);
            $article->setUserId($this->getUser()->getId());
            $article->setImage($data['image']);
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
        $article = Picture::find($id);
        $form    = new AdminArticleEditType($article);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $article->setName($data['name']);
            $article->setSlug($data['slug']);
            $article->setDescription($data['description']);
            $article->setImage($data['image']);
            $article->setUserId($data['user_id']);
            $article->setUpdatedAt(date('Y-m-d H:i:s'));
            $article->save();

            $this->addFlash('success', 'L\'article a bien été modifié');
            $this->redirect('/admin/articles');
        }

        return $this->render('admin/articles/edit', 'back', [
            'form'    => $form->getConfig(),
            'article' => $article,
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
