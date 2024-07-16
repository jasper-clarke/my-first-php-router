<?php

class PostModel
{
    private $db;

    public function __construct()
    {
        // NOTE: The IP mentioned below is the IP of the MySQL server inside a local Docker container
        $this->db = new mysqli('172.17.0.2', 'root', 'wwww', 'blog');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    // Get the post by its slug from the database and return either an array or null if no post is found
    public function getPostBySlug(string $slug): array|null
    {
        $query = "SELECT * FROM posts WHERE slug = '$slug'";
        $result = $this->db->query($query);

        if (!$result) {
            return null;
        }

        $post = $result->fetch_assoc();
        return $post;
    }
}
