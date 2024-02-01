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
use App\Controllers\ErrorController;
use App\Controllers\GalleryController;
use App\Controllers\ImageController;
use App\Controllers\MainController;
use App\Controllers\ProfileController;
use Core\Config\ConfigLoader;
use Core\Router\Router;

require __DIR__ . '/../vendor/autoload.php';

$config = new ConfigLoader();
$config->load();

$router = new Router();

//Error page
$router->get('/errors/{status}', [ErrorController::class, 'error']);

$router->get('/', [MainController::class, 'home']);
$router->get('/contact', [MainController::class, 'contact']);
$router->get('/about', [MainController::class, 'aboutUs']);
$router->get('/gallery', [MainController::class, 'gallery']);
$router->get('/template', [MainController::class, 'template']);
$router->get('/article', [ArticleController::class, 'article']);
$router->get('/images/{path}', [ImageController::class, 'index']);

$router->get('/login', [SecurityController::class, 'login']);
$router->post('/login', [SecurityController::class, 'login']);
$router->get('/register', [SecurityController::class, 'register']);
$router->post('/register', [SecurityController::class, 'register']);
$router->get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
$router->post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
$router->get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);
$router->post('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);

$router->middleware(['auth'])->group(function (Router $router) {
    $router->get('/logout', [SecurityController::class, 'logout']);
    $router->get('/profile', [ProfileController::class, 'index']);

    $router->middleware(['admin'])->prefix('/admin')->group(function (Router $router) {
        $router->get('/', [AdminController::class, 'dashboard']);
        $router->get('/comments', [AdminController::class, 'comments']);
        $router->get('/roles', [AdminController::class, 'roles']);
        $router->get('/pages', [AdminController::class, 'pages']);

        $router->controller(AdminUserController::class)->prefix('/users')->group(function (Router $router) {
            $router->get('/', 'index');
            $router->get('/create', 'create');
            $router->post('/create', 'create');
            $router->get('/edit/{id}', 'edit');
            $router->post('/edit/{id}', 'edit');
            $router->post('/delete/{id}', 'delete');
        });

        $router->controller(AdminCategoryController::class)->prefix('/categories')->group(function (Router $router) {
            $router->get('/', 'index');
            $router->get('/create', 'create');
            $router->post('/create', 'create');
            $router->get('/edit/{id}', 'edit');
            $router->post('/edit/{id}', 'edit');
            $router->post('/delete/{id}', 'delete');
        });

        $router->controller(AdminArticleController::class)->prefix('/articles')->group(function (Router $router) {
            $router->get('/', 'index');
            $router->get('/create', 'create');
            $router->post('/create', 'create');
            $router->get('/edit/{id}', 'edit');
            $router->post('/edit/{id}', 'edit');
            $router->post('/delete/{id}', 'delete');
            $router->post('/delete/images/{id}', 'deleteImage');
        });
    });
});

$router->run();
