<?php

class DashboardController
{
    public function __construct()
    {
        session_start();
        spl_autoload_register(function ($class) {
            include 'app/models/' . $class . '.php';
        });
    }

    public function index(): void
    {
        if (isset($_SESSION['loggedIn'])) {
            $this->render('dashboard');
        } else {
            $this->render('login');
        }
    }

    public function signIn(string $username, string $password): void
    {
        include('config/users.php');
        if ($username == $users['admin'] && $password == $users['password']) {
            $postModel = new PostModel();
            $data = $postModel->getAllPosts();
            $_SESSION['loggedIn'] = true;
            header('Location: /dashboard');
            $this->render('dashboard');
        } else {
            echo 'Invalid username or password';
        }
    }

    public function newPost(string $slug, string $title, string $content): void
    {
        if (!empty($slug) || !empty($title) || !empty($content)) {
            $postModel = new PostModel();
            $postModel->createPost($slug, $title, $content);
            echo 'Post created';
        } else {
            echo 'Slug, title, and content are required';
        }
    }

    private function render(string $view): void
    {
        require_once 'app/views/' . $view . '.php';
    }
}
