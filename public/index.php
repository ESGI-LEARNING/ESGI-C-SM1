<?php
namespace App;

use App\Controllers\MainController;
use App\Controllers\SecurityController;
use App\Core\Router;

require '../Autoloader.php';

Autoloader::register();

$router = new Router();

$router->get('/', [MainController::class, 'home']);
$router->get('/login', [SecurityController::class, 'login']);
$router->get('/register', [SecurityController::class, 'register']);

$router->run();