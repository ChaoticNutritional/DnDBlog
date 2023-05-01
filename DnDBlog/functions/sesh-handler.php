<?php

// sesh-handler.php

// Function to check if user is logged in
function is_user_logged_in() {
    return isset($_SESSION['user_id']);
}

function get_logged_in_username() {
    if (isset($_SESSION['user_id'])) {
        // Query the database to get the user's username
        $conn = mysqli_connect("localhost", "root", "", "BLOG");
        $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $username = $result->fetch_assoc()['username'];
        $stmt->close();
        $conn->close();

        return $username;
    } else {
        return null;
    }
}
