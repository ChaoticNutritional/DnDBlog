<?php
session_start();
include 'persistent/header.php';
include 'persistent/navigation.php';


$conn = mysqli_connect("localhost", "root", "", "BLOG");

if (!$conn) {
    echo "<h3>Unable to establish connection to database</h3>";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['comment']) && isset($_POST['post_id'])) {
        $comment_text = mysqli_real_escape_string($conn, $_POST['comment']);
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];
        $comment_time = date("Y-m-d H:i:s");

        echo "Comment text: " . $comment_text . "<br>";
        echo "Post ID: " . $post_id . "<br>";
        echo "User ID: " . $user_id . "<br>";
        echo "Comment time: " . $comment_time . "<br>";

        $sql = "INSERT INTO comments (post_id, user_id, comment_content, comment_time) VALUES ('$post_id', '$user_id', '$comment_text', '$comment_time')";
        echo $sql;
        $result = mysqli_query($conn, $sql);
        if (mysqli_error($conn)) {
            echo "Error adding comment: " . mysqli_error($conn);
        } else {
            if (mysqli_affected_rows($conn) > 0) {
                echo "Comment added successfully!";
            } else {
                echo "Error adding comment: " . mysqli_error($conn);
            }
        }

        header("Location: post.php?id=$post_id");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}
?>

<script src="functions/functions.js"></script>
<script src="https://cdn.tiny.cloud/1/h4xqfc5szph7wnd4vzl029zrru72p3c96pcgeq94i2k1b2uu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<?php
$post_id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$post = mysqli_fetch_assoc($result);

?>
<div class="together">
    <div class="post">
        <div>
            <div class="titleTime">
                <h3><?php echo $post['title']; ?></h5>
                    <h6><?php echo $post['post_time']; ?></h6>
            </div>
            <!--POST TEXT-->
            <p class="card-text">
                <?php echo $post['content']; ?>
            </p>
        </div>
    </div>

    <!--COMMENTS-->
    <div>
        <?php
        $post_id = $_GET['id'];
        //test
        //$sql = "SELECT * FROM comments WHERE post_id = $post_id";

        $sql = "SELECT comments.comment_content, comments.comment_time, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = $post_id ORDER BY comments.comment_time DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='comment-container'>";
            echo "<p>{$row['comment_content']}</p>";
            echo "<div class='comment-meta'>";
            echo "<h5>Posted by {$row['username']} </h5>";
            echo "<h5>{$row['comment_time']}</h5>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <!--BUTTONS-->
    <div>
        <?php if (is_user_logged_in()) : ?>
            <!--ADD COMMENT-->
            <button type="button" onclick="toggleCommentBox()">Comment</button>

        <?php else : ?>
            <!--LOGIN PAGE-->
            <a href="login.php">Log In</a>
        <?php endif; ?>

        <!--FORM LOGIC-->
        <div hidden id="comment-box" style="display:none;">
            <form action="post.php" method="post">
                <textarea id="comment" name="comment" rows="4" cols="36"></textarea>
                <script>
                    tinymce.init({
                        selector: '#comment'
                    });
                </script>
                <input type="hidden" name="post_id" value="<?php echo $_GET['id']; ?>">
                <br>
                <div class="two-buttons">
                    <button type="submit" value="Comment">Submit</button>
                    <button type="button" onclick="clearPost()">Clear Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'persistent/footer.php'; ?>