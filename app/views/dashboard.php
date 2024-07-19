<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <form action="/dashboard" method="post" class="flex flex-col">
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="new-post-slug" class="border-2 p-2">
        <br>
        <label for="title">Title:</label>
        <input type="text" name="title" id="new-post-title" class="border-2 p-2">
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="new-post-content" class="border-2 p-2"></textarea>
        <br>
        <input type="submit" value="Create Post" class="bg-blue-500 text-white p-2 rounded-lg max-w-fit cursor-pointer">
    </form>
    <hr>
    <h2>Posts</h2>
<?php
    $postModel = new PostModel();
$posts = $postModel->getAllPosts();
foreach ($posts as $post) {

    echo '<div class="w-auto m-6 rounded-lg border-2 p-4 text-2xl font-sans font-extrabold"><h3>' . $post['title'] . '</h3></div>';
}
?>
</body>
</html>
