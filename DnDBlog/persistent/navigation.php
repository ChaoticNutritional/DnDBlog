<?php
$conn = mysqli_connect("localhost", "root", "", "BLOG");
$logged_in_username = get_logged_in_username();

if ($logged_in_username) {
    echo "<p>Welcome, user " . $logged_in_username . "!</p>";
} else {
    echo "<p>You are not logged in.</p>";
}

$recent_post = mysqli_query($conn, "SELECT * FROM posts ORDER BY post_time DESC LIMIT 1") or die(mysqli_error($conn));

$row = mysqli_fetch_assoc($recent_post);

?>
<nav>
    <ul>
        <li><a href="main.php">Home</a></li>
        <li>
            <a href="#">Adventures</a>
            <ul class="dropdown-menu">
                <li><a href="./history.php">History</a></li>
                <li><a href="#">Magic</a></li>
                <li><a href="post.php?id=<?php echo $row['id']; ?>">Most Recent Session</a></li>
            </ul>
        </li>
        <li><a href="./coming_soon.php">Characters</a></li>
        <li><a href="#">About</a></li>
        <li><a href="./contact.php">Contact</a></li>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['access_level'] == 1) : ?>
            <li class="addPost"><a href="addPost.php">Create Post!</a></li>
        <?php endif; ?>
        <?php if (is_user_logged_in()) : ?>
            <li class="log"><a href="functions/logout.php">Log Out</a></li>
        <?php else : ?>
            <li class="log"><a href="login.php">Log In</a></li>
        <?php endif; ?>

    </ul>
</nav>