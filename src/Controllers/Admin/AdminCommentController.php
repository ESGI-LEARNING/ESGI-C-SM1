<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use App\Mails\CommentMail;
use Core\Controller\AbstractController;
use Core\Pagination\Paginator;
use Core\Views\View; 
use Core\Pagination\HttpRequest;


class AdminCommentController extends AbstractController
{
    public function index(): View
    {
        $itemsPerPage = 10;
        $commentModel = new Comment();
        $totalItems = $commentModel->count();
    
        // Utilisation de la classe HttpRequest pour récupérer le numéro de page
        $page = HttpRequest::getIntParam('page');
    
     // Création d'un objet Paginator pour gérer la pagination
     $paginator = new Paginator($totalItems, $itemsPerPage, $page, '/admin/comments?page=%d');
     $offset = $paginator->getOffset(); // Calcul de l'offset à utiliser dans la requête SQL

     // Récupération des commentaires à afficher sur la page actuelle
     $comments = $commentModel->findWithPagination($itemsPerPage, $offset);

     // Rendu de la vue avec les commentaires et le paginateur
     return $this->render('admin/comments/index', 'back', [
         'comments' => $comments, // Liste des commentaires à afficher
         'paginator' => $paginator, // Objet Paginator pour gérer la pagination dans la vue
     ]);
 }
    
    

    public function delete(int $id): void
    {
        $comment = Comment::find($id);
    
        if ($comment) {
            $comment->setIsDeleted(true);
            $comment->save();
    
            $this->addFlash('success', 'Le commentaire a bien été supprimé');
            $this->redirect('/admin/comments');
        }
    }
    public function report(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->setIsReported(true);
            $comment->save();

            // Envoyer un mail à l'admin
            $mail = new CommentMail();
            $mail->sendReportComment('quentinandrieu@yahoo.com', [
                'comment_id' => $comment->getId(),
                'content' => $comment->getContent(),
            ]);

            $this->addFlash('success', 'Le commentaire a été signalé avec succès.');
        } else {
            $this->addFlash('error', 'Commentaire non trouvé.');
        }

        $this->redirect('/admin/comments');
    }
    public function keep(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->setIsReported(false); // Marquer comme non signalé
            $comment->save();

            $this->addFlash('success', 'Le commentaire a été gardé.');
        } else {
            $this->addFlash('error', 'Commentaire non trouvé.');
        }

        $this->redirect('/admin/comments');
    }
}
