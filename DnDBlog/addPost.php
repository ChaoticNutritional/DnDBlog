<?php
session_start();
// Define variables for header, footer, and navigation
$header = 'persistent/header.php';
$footer = 'persistent/footer.php';
$navigation = 'persistent/navigation.php';
$logic = 'functions/logic.php';
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Add Post</title>
</head>

<body>
    <!-- Include header and navigation -->
    <?php include($header); ?>
    <?php include($navigation); ?>
    <?php include($logic); ?>
    <script src="https://cdn.tiny.cloud/1/h4xqfc5szph7wnd4vzl029zrru72p3c96pcgeq94i2k1b2uu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <h1 class="newPost">Add Post</h1>

    <div class="newPost">
        <form method="POST">
            <input type="text" id="title" name="title" placeholder="Post Title"> <br>
            <textarea id="content" rows="10" cols="50" name="content"></textarea> <br>
            <script>
                tinymce.init({
                    selector: '#content'
                });
            </script>
            <button name="make_post">Post</button>
        </form>
    </div>
    <!-- Include footer -->
    <?php include($footer); ?>
</body>

</html>