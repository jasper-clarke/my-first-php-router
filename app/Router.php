<?php

class Router
{
    private $routes = [];

    public function __construct()
    {
        // Include and process the route configurations from config/routes.php
        require_once 'config/routes.php';
        // Each route should have a method, URL, and callback function for its relevant controller
        foreach ($routes as $route) {
            $this->addRoute($route['method'], $route['url'], $route['callback']);
        }
    }
    /**
     * @param callable(): mixed $callback
     */
    public function addRoute(string $method, string $url, callable $callback): void
    {
        // Add route to the internal array
        $this->routes[$method . '/' . $url] = $callback;
    }
    public function dispatch(string $requestMethod, string $url): mixed
    {
        // First, check if the request is to a /posts/ route
        if (str_starts_with($url, '/posts/')) {
            $newUrl = substr($url, 0, strlen('/posts/'));
            $slug = substr($url, strlen('/posts/'));
            // echo '<br>' . $slug;
            return call_user_func($this->routes[$requestMethod . '/' . $newUrl], $slug);
            // If it's not a /posts/ route, check if it's a hard defined route
        } elseif (isset($this->routes[$requestMethod . '/' . $url])) {
            if ($requestMethod == 'POST') {
                return call_user_func($this->routes[$requestMethod . '/' . $url], $_POST);
            } else {
                return call_user_func($this->routes[$requestMethod . '/' . $url]);
            }
            // Call the corresponding callback without capturing any route parameters
        } else {
            // TODO: Handle unknown routes with a proper 404 error page
            echo '<br>Route not found';
            return 'Route not found';
        }
    }
}
