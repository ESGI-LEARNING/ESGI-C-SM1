<?php

namespace Core\Router;

class Router
{
    private array $routes = [];

    private array $middleware = [];

    private ?string $prefix = null;

    private ?string $controller = null;

    public function addRoute(string $method, string $uri, array|string $callable, array $middleware = []): void
    {
        $this->routes[] = [
            'method'      => $method,
            'uri'         => $uri,
            'callable'    => $callable,
            'middlewares' => $middleware,
        ];
    }

    public function middleware(array $middleware): Router
    {
        $this->middleware = $middleware;

        return $this;
    }

    public function controller(string $name): Router
    {
        $this->controller = $name;

        return $this;
    }

    public function prefix(string $name): Router
    {
        $this->prefix = $name;

        return $this;
    }

    public function group(\Closure $callback): void
    {
        $router = new self();
        $callback($router);

        foreach ($router->routes as $route) {
            if (count($this->middleware) > 0) {
                $route['middlewares'][] = $this->middleware;
            }

            if ($this->prefix !== null) {
                if ($route['uri'] === '/') {
                    $route['uri'] = $this->prefix;
                } else {
                    $route['uri'] = rtrim($this->prefix, '/').$route['uri'];
                }
            }

            if ($this->controller !== null) {
                $route['callable'] = [$this->controller, $route['callable']];
            }

            $this->routes[] = $route;
        }

        $this->middleware = [];
        $this->prefix     = null;
        $this->controller = null;
    }

    public function get(string $uri, array|string $callable): Router
    {
        $this->addRoute('GET', $uri, $callable, $this->middleware);

        return $this;
    }

    public function post(string $uri, array|string $callable): Router
    {
        $this->addRoute('POST', $uri, $callable, $this->middleware);

        return $this;
    }

    public function delete(string $uri, array|string $callable): Router
    {
        $this->addRoute('DELETE', $uri, $callable, $this->middleware);

        return $this;
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = strtolower($_SERVER['REQUEST_URI']);
        $uri    = strtok($uri, '?');
        $uri    = strlen($uri) > 1 ? rtrim($uri, '/') : $uri;

        foreach ($this->routes as $route) {
            $pattern = $this->getRoutePattern($route['uri']);

            if (preg_match($pattern, $uri, $matches) && $route['method'] === $method) {
                array_shift($matches);

                // On verifie les accès de l'utilisateurs

                foreach (array_reverse($route['middlewares']) as $middleware) {
                    $middleware = ucfirst($middleware[0]);
                    $middleware = 'App\\Middlewares\\'.ucfirst($middleware).'Middleware';
                    $middleware = new $middleware();
                    $middleware();
                }

                $callable = $route['callable'];

                if (is_array($callable) && 2 === count($callable)) {
                    include '../src/'.str_replace(['App\\', '\\'], ['', '/'], $callable[0]).'.php';
                    $controllerName = $callable[0];
                    $methodName     = $callable[1];

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

        // Return 404
        http_response_code(404);
    }

    private function getRoutePattern(string $uri): string
    {
        $routePattern = preg_replace('/\/{([a-zA-Z0-9_]+)}/', '/([^\/]+)', $uri);

        return '#^'.$routePattern.'$#';
    }
}
