<?php
namespace App;

use App\Controllers\MainController;
use App\Controllers\SecurityController;
use App\Core\Router;

require '../Autoloader.php';

Autoloader::register();

$router = new Router();

$router->get('/', [MainController::class, 'home']);
$router->get('/contact', [MainController::class, 'contact']);
$router->get('/a-propos', [MainController::class, 'aboutUs']);
$router->get('/gallery', [MainController::class, 'gallery']);
$router->get('/login', [SecurityController::class, 'login']);
$router->get('/register', [SecurityController::class, 'register']);
$router->get('/logout', [SecurityController::class, 'logout']);

$router->run();