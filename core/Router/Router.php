<?php

namespace Core\Router;

use App\Controllers\ErrorController;

class Router
{
    private array $routes = [];

    private static ?Router $instance = null;

    public static function getInstance(): Router
    {
        if (!self::$instance) {
            self::$instance = new self();
            self::$instance->run();
        }

        return self::$instance;
    }

    public function get(string $uri, array $callable): void
    {
        $this->addRoute('GET', $uri, $callable);
    }

    public function addRoute(string $method, string $uri, array $callable): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'callable' => $callable,
        ];
    }

    public function post(string $uri, array $callable): void
    {
        $this->addRoute('POST', $uri, $callable);
    }

    public function delete(string $uri, array $callable): void
    {
        $this->addRoute('DELETE', $uri, $callable);
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = strtolower($_SERVER['REQUEST_URI']);
        $uri = strtok($uri, '?');
        $uri = strlen($uri) > 1 ? rtrim($uri, '/') : $uri;

        foreach ($this->routes as $route) {
            $pattern = $this->getRoutePattern($route['uri']);

            if (preg_match($pattern, $uri, $matches) && $route['method'] === $method) {
                array_shift($matches);

                $callable = $route['callable'];

                if (is_array($callable) && 2 === count($callable)) {
                    include '../src/' . str_replace(['App\\', '\\'], ['', '/'], $callable[0]) . '.php';
                    $controllerName = $callable[0];
                    $methodName = $callable[1];

                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();

                        if (method_exists($controller, $methodName)) {
                            // Appeler la méthode avec les paramètres extraits
                            call_user_func_array([$controller, $methodName], $matches);
                        } else {
                            http_response_code(500);
                            echo 'L\'action n\'existe pas dans le contrôleur';
                        }
                    } else {
                        http_response_code(500);
                        echo 'L\'action n\'existe pas dans le contrôleur';
                    }
                } else {
                    http_response_code(500);
                    echo 'Erreur interne du serveur';
                }

                return;
            }
        }

        include '../src/Controllers/ErrorController.php';
        $errorController = new ErrorController();
        $errorController->page404();
    }

    private function getRoutePattern(string $uri): string
    {
        $routePattern = preg_replace('/\/{([a-zA-Z0-9_]+)}/', '/([^\/]+)', $uri);
        return '#^' . $routePattern . '$#';
    }
}
