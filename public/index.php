<?php

use App\Controllers\AboutUsController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Auth\ForgotPasswordController;
use App\Controllers\Auth\SecurityController;
use App\Controllers\ContactController;
use App\Controllers\GalleryController;
use App\Controllers\MainController;
use Core\Config\ConfigLoader;
use Core\Router\Router;

require __DIR__.'/../vendor/autoload.php';

// Start read config file
$config = new ConfigLoader();
$config->load();

$router = new Router();

$router->get('/', [MainController::class, 'home']);
$router->get('/contact', [ContactController::class, 'contact']);
$router->get('/about', [AboutUsController::class, 'aboutUs']);
$router->get('/gallery', [GalleryController::class, 'gallery']);

$router->get('/login', [SecurityController::class, 'login']);
$router->post('/login', [SecurityController::class, 'login']);
$router->get('/register', [SecurityController::class, 'register']);
$router->post('/register', [SecurityController::class, 'register']);
$router->get('/logout', [SecurityController::class, 'logout']);
$router->get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
$router->post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
$router->get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);
$router->post('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);

$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('/admin/comments', [AdminController::class, 'comments']);
$router->get('/admin/roles', [AdminController::class, 'roles']);
$router->get('/admin/pages', [AdminController::class, 'pages']);

$router->run();
