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
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE slug = ?");
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            return null;
        }

        $post = $result->fetch_assoc();
        return $post;
    }

    // Get all posts from the database and return an array of arrays
    public function getAllPosts(): array|null
    {
        $stmt = $this->db->prepare("SELECT * FROM posts");
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            return null;
        }

        $posts = array();
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    }

    public function createPost(string $slug, string $title, string $content): void
    {
        $stmt = $this->db->prepare("INSERT INTO posts (slug, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $slug, $title, $content);
        $stmt->execute();
        $result = $stmt->get_result();
        echo $result;
    }
}
