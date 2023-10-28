<?php

namespace App\Controllers;

use App\Core\Views\View;

Dashboard avec de la datavisualisation Chartjs
Configuration du templating Blade
CRUD des commentaires
CRUD utilisation et gestion des rôles des utilisateurs
CRUD des pages

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


}

