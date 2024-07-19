<?php

spl_autoload_register(function ($class) {
    if (str_contains($class, 'Controller')) {
        include 'app/controllers/' . $class . '.php';
    } else {
        include 'app/models/' . $class . '.php';
    }
});

// Define routes for the application
$routes = [];

// Add a route for GET requests to the root URL
$routes[] = array('method' => 'GET', 'url' => '', 'callback' => function () {
    $homeController = new HomeController();
    return call_user_func(array($homeController, 'index'));
});

$routes[] = array('method' => 'GET', 'url' => '/dashboard', 'callback' => function () {
    $dashboardController = new DashboardController();
    return call_user_func(array($dashboardController, 'index'));
});

$routes[] = array('method' => 'POST', 'url' => '/login', 'callback' => function ($data) {
    $dashboardController = new DashboardController();
    return call_user_func(array($dashboardController, 'signIn'), $data['username'], $data['password']);
});

$routes[] = array('method' => 'POST', 'url' => '/dashboard', 'callback' => function (array $data) {
    $dashboardController = new DashboardController();
    return call_user_func(array($dashboardController, 'newPost'), $data['slug'], $data['title'], $data['content']);
});

// Create a base route for GET requests to /posts/
$routes[] = array('method' => 'GET', 'url' => "/posts/", 'callback' => function ($slug) {
    $postController = new PostController();
    // For the callback function, pass the slug as an argument
    return call_user_func(array($postController, 'getPost'), $slug);
});
