<?php
session_start();
include 'persistent/header.php';
include 'persistent/navigation.php';

$conn = mysqli_connect("localhost", "root", "", "BLOG");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {

        // set variables equal to post username and password
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // check inputs
        if (!preg_match('/^[a-zA-Z\s\'-]+$/', $firstname) || !preg_match('/^[a-zA-Z\s\'-]+$/', $lastname)) {
            $error_message .= "Name contains invalid characters.<br>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message .= "Please enter a valid email address.<br>";
        }

        if (!preg_match('/^[a-zA-Z0-9_\.]+$/', $username)) {
            $error_message .= "Invalid username.<br>";
        } else {
            // check if username already exists
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_message .= "Username already exists. Please choose a different username.<br>";
            }
        }

        if (empty($error_message)) {
            // Insert user into database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, email) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $hashed_password, $firstname, $lastname, $email);
            $stmt->execute();
            $success_message = "Registration successful. Please log in.";
            header("Location: login.php?success_message=$success_message");
        }
    } else {
        $error_message = "Invalid request. Please try again.";
    }
}
?>



<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Register</h2>
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="form-group" style="display: inline-block;">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="register" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include 'persistent/footer.php'; ?>