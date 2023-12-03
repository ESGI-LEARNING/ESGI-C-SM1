<?php

use App\Controllers\Admin\AdminController;
use App\Controllers\Auth\SecurityController;
use App\Controllers\MainController;
use Core\ConfigLoader;
use Core\Router;

require __DIR__.'/../vendor/autoload.php';

// Start read config file
$config = new ConfigLoader();
$config->load();

$router = new Router();

$router->get('/', [MainController::class, 'home']);
$router->get('/contact', [MainController::class, 'contact']);
$router->get('/a-propos', [MainController::class, 'aboutUs']);
$router->get('/gallery', [MainController::class, 'gallery']);

$router->get('/login', [SecurityController::class, 'login']);
$router->get('/register', [SecurityController::class, 'register']);
$router->get('/logout', [SecurityController::class, 'logout']);

$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('/admin/comments', [AdminController::class, 'comments']);
$router->get('/admin/roles', [AdminController::class, 'roles']);
$router->get('/admin/pages', [AdminController::class, 'pages']);
$router->get('/admin/login', [AdminController::class, 'login']);
$router->get('/admin/register', [AdminController::class, 'register']);
$router->get('/admin/logout', [AdminController::class, 'logout']);

$router->run();
