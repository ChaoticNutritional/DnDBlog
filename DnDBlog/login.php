<?php
include 'persistent/header.php';
include 'persistent/navigation.php';

$conn = mysqli_connect("localhost", "root", "", "BLOG");

if (isset($_GET['success_message'])) {
    $success_message = $_GET['success_message'];
    echo "<div class='alert alert-success'>$success_message</div>";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $access_level = $user['access_level'];

        // Retrieve user from database
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $success_message = "Login Success!";
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['access_level'] = $user['access_level'];
                header("Location: main.php?success_message=$success_message");
                exit;
            } else {
                $error_message = "Invalid password. Please try again.";
                echo "Error: " . $error_message;
            }
        } else {
            $error_message = "User not found. Please check your username and try again.";
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Login</h2>
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Submit</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>

<?php include 'persistent/footer.php'; ?>