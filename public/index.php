<?php

use App\Controllers\Admin\AdminArticleController;
use App\Controllers\AboutUsController;
use App\Controllers\Admin\AdminCategoryController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\AdminUserController;
use App\Controllers\ArticleController;
use App\Controllers\Auth\ForgotPasswordController;
use App\Controllers\Auth\SecurityController;
use App\Controllers\ContactController;
use App\Controllers\GalleryController;
use App\Controllers\MainController;
use Core\Config\ConfigLoader;
use Core\Router\Router;

require __DIR__.'/../vendor/autoload.php';

$config = new ConfigLoader();
$config->load();

$router = new Router();

$router->get('/', [MainController::class, 'home']);
$router->get('/contact', [ContactController::class, 'contact']);
$router->get('/about', [AboutUsController::class, 'aboutUs']);
$router->get('/gallery', [GalleryController::class, 'gallery']);
$router->get('/template', [MainController::class, 'template']);
$router->get('/artist', [MainController::class, 'artist']);
$router->get('/article', [ArticleController::class, 'article']);

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

$router->get('/admin/users', [AdminUserController::class, 'index']);
$router->get('/admin/users/create', [AdminUserController::class, 'create']);
$router->post('/admin/users/create', [AdminUserController::class, 'create']);
$router->get('/admin/users/edit/{id}', [AdminUserController::class, 'edit']);
$router->post('/admin/users/edit/{id}', [AdminUserController::class, 'edit']);
$router->post('/admin/users/delete/{id}', [AdminUserController::class, 'delete']);

$router->get('/admin/categories', [AdminCategoryController::class, 'index']);
$router->get('/admin/categories/create', [AdminCategoryController::class, 'create']);
$router->post('/admin/categories/create', [AdminCategoryController::class, 'create']);
$router->get('/admin/categories/edit/{id}', [AdminCategoryController::class, 'edit']);
$router->post('/admin/categories/edit/{id}', [AdminCategoryController::class, 'edit']);
$router->post('/admin/categories/delete/{id}', [AdminCategoryController::class, 'delete']);

$router->get('/admin/articles', [AdminArticleController::class, 'index']);
$router->get('/admin/articles/create', [AdminArticleController::class, 'create']);
$router->post('/admin/articles/create', [AdminArticleController::class, 'create']);
$router->get('/admin/articles/edit/{id}', [AdminArticleController::class, 'edit']);
$router->post('/admin/articles/edit/{id}', [AdminArticleController::class, 'edit']);
$router->post('/admin/articles/delete/{id}', [AdminArticleController::class, 'delete']);

$router->run();
