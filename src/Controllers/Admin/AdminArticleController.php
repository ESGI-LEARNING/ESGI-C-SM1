<?php

namespace App\Controllers\Admin;

use App\Form\Article\AdminArticleCreateType;
use App\Form\Article\AdminArticleEditType;
use App\Models\Picture;
use Core\Auth\Auth;
use Core\Controller\AbstractController;
use Core\FileStorage\Storage;
use Core\Views\View;

class AdminArticleController extends AbstractController
{
    public function index(): View
    {
        $articles = Picture::query()
            ->with(['user', 'images'])
            ->findAll();

        return $this->render('admin/articles/index', 'back', [
            'articles' => $articles,
        ]);
    }

    public function create(): View
    {
        $article = new Picture();
        $form    = new AdminArticleType($article);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {

            //upload image

            $pathFile = Storage::upload($form->file('images'), 'media');

            $article->setName($form->get('name'));
            $article->setSlug(slug($form->get('name')));
            $article->setDescription($form->get('description'));
            $article->setUserId(Auth::id());
            $article->save();

            /*
            $article->sync(
                'picture_category',
                $article->getId(),
                Category::find($article->getId())->getId()
            );
            */

            $this->addFlash('success', 'L\'article a bien été créé');
            $this->redirect('/admin/articles');
        }

        return $this->render('admin/articles/create', 'back', [
            'form' => $form->getConfig(),
        ]);
    }

    public function edit(int $id): View
    {
        $article = Picture::query()
            ->with(['user', 'images'])
            ->getOneBy(['id' => $id]);

        $form       = new AdminArticleEditType($article);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setName($form->get('name'));
            $article->setSlug(slug($form->get('name')));
            $article->setDescription($form->get('description'));
            $article->setUserId(Auth::id());
            $article->setUpdatedAt(date('Y-m-d H:i:s'));
            $article->save();
            /*
            $article->sync(
                'picture_category',
                $article->getId(),
                Category::find($article->getId())->getId()

            );
            */

            $this->addFlash('success', 'L\'article a bien été modifié');
            $this->redirect('/admin/articles');
        }

        return $this->render('admin/articles/edit', 'back', [
            'form'    => $form->getConfig(),
            'article' => $article,
        ]);
    }

    public function delete(int $id): void
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
