<?php

namespace App\Controllers;

use App\Core\Views\View;

class AdminController
{
    public function dashboard()
    {
        $myView = new View("admin/dashboard", "back");
    }
    public function comments()
    {
        $myView = new View("admin/comments", "back");
    }
    public function roles()
    {
        $myView = new View("admin/roles", "back");
    }
    public function pages()
    {
        $myView = new View("admin/pages", "back");
    }
    //connexion
    public function login()
    {
        $myView = new View("admin/login", "back");
    }
    //inscription
    public function register()
    {
        $myView = new View("admin/register", "back");
    }
    //deconnexion
    public function logout()
    {
        $myView = new View("admin/logout", "back");
    }

}