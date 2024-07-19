<?php

require_once('app/Router.php');

// spl_autoload_register(function ($class) {
//     include 'app/' . $class . '.php';
// });


$router = new Router();
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '') {
    $response = $router->dispatch($requestMethod, $_SERVER['PATH_INFO']);
} else {
    // TODO: Requests to the index page should be handled by NGINX realistically
    $response = $router->dispatch($requestMethod, '');
}

?>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/output.css">
</head>






