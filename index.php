<?php

require_once('app/Router.php');
$router = new Router();
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '') {
    $response = $router->dispatch($requestMethod, $_SERVER['PATH_INFO']);
} else {
    // TODO: Requests to the index page should be handled by NGINX realistically
    $response = $router->dispatch($requestMethod, '');
}
