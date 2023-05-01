<div class="container">
    <div class="row">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "BLOG");

        if (!$conn) {
            #debugging
            echo "<h3 class='container bg-dark text-center p-3 text-warning rounded-lg mt-5'>Unable to establish connection to database</h3>";
        }
        $query = "SELECT * FROM posts";
        $posts = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($posts)) {
            echo '<div class="together">';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '<p>' . substr($row['content'], 0, 100) . '...</p>';
            echo '<a href="post.php?id=' . $row['id'] . '">Read More</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>