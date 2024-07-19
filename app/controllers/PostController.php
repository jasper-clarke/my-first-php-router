<?php

class PostController
{
    // NOTE: Acts as the callback function for the "/posts/" route
    public function getPost(string $slug): void
    {
        // Create an new post model and get the post by its slug
        include_once 'app/models/PostModel.php';
        $postModel = new PostModel();
        $post = $postModel->getPostBySlug($slug);
        // If no post is found, render the "postNotFound" view
        if (!$post) {
            $this->render('postNotFound', array());
        } else {
            // Otherwise, render the "post" view and pass the post data to the view via the $GLOBALS array
            $this->render('post', $post);
        }
    }
    // Render the view with the given path
    private function render(string $view, array $data): void
    {
        $postData = $data;
        require_once 'app/views/' . $view . '.php';
    }
}
