<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use App\Models\Picture;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\Views\View;

class AdminController extends AbstractController
{
    public function dashboard(): View
    {

        $nbUsers    = User::count();
        $nbComments = Comment::count();
        $nbImages   = Picture::count(); 

        $nbDeletedUsers = User::count(['is_deleted' => 1]);

        $nbReportedComments = Comment::count(['is_reported' => 1]);
        $nbDeletedComments = Comment::count(['is_deleted' => 1]);


        return $this->render('admin/dashboard', 'back', [
            'nbUsers' => $nbUsers,
            'nbComments' => $nbComments,
            'nbImages' => $nbImages,
            'nbDeletedUsers' => $nbDeletedUsers,
            'nbReportedComments' => $nbReportedComments,
            'nbDeletedComments' => $nbDeletedComments,
        ]);

    }

    public function comments(): View
    {
        $comments = Comment::findAll();

        return $this->render('admin/comments', 'back', [
            'comments' => $comments,
        ]);
    }

    public function roles(): View
    {
        return $this->render('admin/roles', 'back');
    }
}
