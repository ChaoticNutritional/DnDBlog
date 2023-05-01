<?php
session_start();
// Define variables for header, footer, and navigation
$header = 'persistent/header.php';
$footer = 'persistent/footer.php';
$navigation = 'persistent/navigation.php';
$fetchPosts = 'functions/fetchPosts.php';
if (isset($_GET['success_message'])) {
    $success_message = $_GET['success_message'];
    echo "<div class='alert alert-success'>$success_message</div>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tales from Elysium</title>
</head>

<body>
    <!-- Include header and navigation -->

    <?php include($header); ?>
    <?php include($navigation); ?>

    <!-- Main content area -->
    <div id="together">
        <div class="together">
            <h1>Welcome to My Blog!</h1>
            <h4>This page will document mine and my group's adventures in the world of Elysium, an American old west based fantasy setting created for use with Dungeons & Dragons 5th edition. As your chronicler of the stories of this game, I will be known as The Narrator. Why not sit a while, warm yourself by the fire, and listen to a tale of the unlikeliest of heroes...</h4>
        </div>

        <?php include($fetchPosts); ?>
    </div>
    </div>

    <!-- Include footer -->
    <?php include($footer); ?>
</body>

</html>