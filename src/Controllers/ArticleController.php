<?php

namespace App\Controllers;

use App\Models\Picture;
use App\Models\Comment;
use Core\Controller\AbstractController;
use Core\Views\View;
use Core\Auth\Auth;
use App\Mails\CommentMail;

class ArticleController extends AbstractController
{
    public function article(string $name): View
    {
        $article = Picture::query()
            ->with(['image'])
            ->where('picture.name', '=', $name)
            ->get()[0];

        
        $comments = Comment::query()
            ->with(['user'])
            ->join('picture_comment', 'picture_comment.comment_id', '=', 'comment.id')
            ->where('picture_comment.picture_id', '=', $article->getId())
            ->get();
        
        return $this->render('main/article', 'front', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function addComment(int $pictureId)
    {
        $content = $_POST['comment'];

        if(Auth::check()){
            $comment = new Comment();
            $comment->setContent($content);
            $comment->setUser(Auth::id());
            $comment->setCreatedAt(date('Y-m-d H:i:s'));
            $comment->save(); 
        }

        $picture = Picture::query()
            ->where('id', '=', $pictureId)
            ->get()[0];
        

        $picture->comments()->sync([$comment->getId()]);
        $picture->save();
       
        $this->redirect("/article/{$picture->getSlug()}");
    }

}
