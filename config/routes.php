<?php

// Define routes for the application
$routes = array();

// Add a route for GET requests to the root URL
$routes[] = array('method' => 'GET', 'url' => '', 'callback' => function () {
    include_once 'app/controllers/HomeController.php';
    $homeController = new HomeController();
    return call_user_func(array($homeController, 'index'));
});

// Create a base route for GET requests to /posts/
$routes[] = array('method' => 'GET', 'url' => "/posts/", 'callback' => function ($slug) {
    include_once 'app/controllers/PostController.php';
    $postController = new PostController();
    // For the callback function, pass the slug as an argument
    return call_user_func(array($postController, 'getPost'), $slug);
});
