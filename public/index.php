<?php

use App\Controllers\Admin\AdminArticleController;
use App\Controllers\Admin\AdminCategoryController;
use App\Controllers\Admin\AdminCommentController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\AdminLogController;
use App\Controllers\Admin\AdminUserController;
use App\Controllers\ArticleController;
use App\Controllers\Auth\ForgotPasswordController;
use App\Controllers\Auth\SecurityController;
use App\Controllers\Auth\VerifyEmailController;
use App\Controllers\ErrorController;
use App\Controllers\ImageController;
use App\Controllers\Install\InstallController;
use App\Controllers\MainController;
use App\Controllers\ProfileController;
use Core\Config\ConfigLoader;
use Core\Router\Router;

require __DIR__.'/../vendor/autoload.php';

$config = new ConfigLoader();
$config->load();

$router = new Router();

// Error page
$router->get('/errors/{status}', [ErrorController::class, 'error']);

$router->middleware(['install'])->group(function (Router $router) {
    $router->controller(InstallController::class)->prefix('/install')->group(function (Router $router) {
        $router->get('/', 'index');
        $router->get('/db', 'db');
        $router->post('/db', 'db');
        $router->get('/smtp', 'smtp');
        $router->post('/smtp', 'smtp');
        $router->get('/admin-user', 'adminUser');
        $router->post('/admin-user', 'adminUser');
    });
});

$router->middleware(['installed'])->group(function (Router $router) {
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
    $router->get('/verify-email/{id}/{token}', [VerifyEmailController::class, 'index']);
    $router->get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    $router->post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    $router->get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);
    $router->post('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);

    $router->middleware(['auth'])->group(function (Router $router) {
        $router->get('/logout', [SecurityController::class, 'logout']);

        $router->controller(ProfileController::class)->prefix('/profile')->group(function (Router $router) {
            $router->get('/', 'index');
            $router->post('/', 'edit');
            $router->get('/author', 'author');
            $router->post('/author', 'editAuthor');
            $router->post('/delete', 'delete');
            $router->post('/avatar', 'updateAvatar');
            $router->get('/reset-password', 'password');
            $router->post('/reset-password', 'resetPassword');
        });

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
            $router->controller(AdminCommentController::class)->prefix('/comments')->group(function (Router $router) {
                $router->get('/', 'index');
                $router->post('/report/{id}', 'report');
                $router->post('/delete/{id}', 'delete');
                $router->post('/keep/{id}', 'keep');
            });

            $router->controller(AdminLogController::class)->prefix('/logs')->group(function (Router $router) {
                $router->get('/', 'index');
            });
        });
    });
});

$router->run();
