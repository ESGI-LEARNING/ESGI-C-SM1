<?php

namespace App\Controllers;

use App\Models\Page;
use App\Form\FormContactType;
use App\Mails\ContactMail;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\Views\View;

class MainController extends AbstractController
{
    public function home(): View
    {
        $page = new Page();
        $page = $page::query()
            ->where('slug', '=', $_SERVER['REQUEST_URI'])
            ->get()[0];

        return $this->render('main/home', 'front', [
            'meta' => $page,
            'page' => $page
        ]);
    }

    public function aboutUs(): View
    {
        $page = new Page();
        $page = $page::query()
            ->where('slug', '=', $_SERVER['REQUEST_URI'])
            ->get()[0];

        return $this->render('main/aboutUs', 'front', [
            'meta' => $page,
            'page' => $page
        ]);
    }

    public function contact(): View
    {
        $form = new FormContactType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {

            $mail = new ContactMail();
            $mail->send([
                'username' => $form->get('username'),
                'email' => $form->get('email'),
                'content' => $form->get('content'),
            ]);

            $this->addFlash('success', 'Votre message à bien été envoyé');
            $this->redirect('/contact');
        }
        $page = new Page();
        $page = $page::query()
            ->where('slug', '=', $_SERVER['REQUEST_URI'])
            ->get()[0];

        return $this->render('main/contact', 'front', [
            'form' => $form->getConfig(),
            'page' => $page,
            'meta' => $page,
        ]);
    }

    public function gallery(): View
    {
        return $this->render('main/gallery', 'front');
    }

    public function artist(): View
    {
        return $this->render('main/artist', 'front');
    }
}
