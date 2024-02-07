<?php

namespace App\Controllers\Admin;

use App\Form\Admin\Article\AdminArticleType;
use App\Models\Image;
use App\Models\Picture;
use App\Service\UploadFile;
use Core\Auth\Auth;
use Core\Controller\AbstractController;
use Core\FileStorage\Storage;
use Core\Views\View;

class AdminArticleController extends AbstractController
{
    public function index(): View
    {
        $articles = Picture::query()
            ->with(['user'])
            ->paginate(10, (int)$this->request()->get('page'));

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
            $article->setName($form->get('name'));
            $article->setSlug(slug($form->get('name')));
            $article->setDescription($form->get('description'));
            $article->setUserId(Auth::id());
            $article->save();

            UploadFile::uploadImageArticles($form->file('images'), $article->getId());

            // Save categories
            $article->categories()->sync($form->get('categories'));

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
            ->with(['images', 'categories'])
            ->getOneBy(['id' => $id]);

        $form = new AdminArticleType($article);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setName($form->get('name'));
            $article->setSlug(slug($form->get('name')));
            $article->setDescription($form->get('description'));
            $article->setUserId(Auth::id());
            $article->setUpdatedAt(date('Y-m-d H:i:s'));
            $article->save();

            if ($form->file('images')) {
                UploadFile::uploadImageArticles($form->file('images'), $article->getId());
            }

            // Save categories
            $article->categories()->sync($form->get('categories'));

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
            if ($this->verifyCsrfToken()) {
                $article->setIsDeleted(1);
                $article->save();

                $this->addFlash('success', 'L\'article a bien été supprimé');
                $this->redirect('/admin/articles');
            }
        }
    }

    public function deleteImage(int $id): void
    {
        $image = Image::find($id);

        if ($image) {
            Storage::delete($image->getImage());

            $image->delete();
            $this->addFlash('success', 'L\'images à bien été supprimé');
            $this->previous();
        }

        $this->addFlash('danger', "Une error c'est produite lors de la suppréssion");
    }
}
