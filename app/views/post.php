<?php
$data = $data;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $data['title']; ?> | Jasper at Windswept</title>
</head>
<body class="bg-black text-white flex flex-col  items-center">
    <main class="flex flex-col w-2/3">
        <h1 class="text-3xl font-bold font-sans"><?php echo $data['title']; ?></h1>
        <div class="h-2 bg-gray-400 w-full"></div>
        <?php echo $data['content']; ?>
    </main>
</body>
</html>
