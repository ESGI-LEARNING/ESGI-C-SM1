<?php

namespace App\Controllers;

use App\Form\FormContactType;
use App\Mails\ContactMail;
use Core\Controller\AbstractController;
use Core\Views\View;

class MainController extends AbstractController
{
    public function home(): View
    {
        return $this->render('main/home', 'front');
    }

    public function aboutUs(): View
    {
        return $this->render('main/aboutUs', 'front');
    }

    public function contact(): View
    {
        $form = new FormContactType();
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $mail = new ContactMail();
            $mail->send([
                'username' => $form->get('username'),
                'email'    => $form->get('email'),
                'content'  => $form->get('content'),
            ]);

            $this->addFlash('success', 'Votre message à bien été envoyé');
            $this->redirect('/contact');
        }

        return $this->render('main/contact', 'front', [
            'form' => $form->getConfig(),
        ]);
    }

    public function template(): View
    {
        return $this->render('main/template', 'front');
    }

    public function artist(): View
    {
        return $this->render('main/article', 'front');
    }

}
