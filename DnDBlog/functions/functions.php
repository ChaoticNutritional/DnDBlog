<?php
session_start();
include 'persistent/header.php';
include 'persistent/navigation.php';
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "BLOG");

// Check if the connection was successful
if (!$conn) {
    #debugging
    echo "<h3 class='container bg-dark text-center p-3 text-warning rounded-lg mt-5'>Unable to establish connection to database</h3>";
}

// Handle form selection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['formchoice'])) {

        // set variables equal to post username and password
        $formtype = $_POST['formtype'];
    } else {
        $error_message = "Invalid request. Please try again.";
    }
}

// Handle form choice
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_form'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // check inputs
        if (!preg_match('/^[a-zA-Z\s\'-]+$/', $firstname) || !preg_match('/^[a-zA-Z\s\'-]+$/', $lastname)) {
            $error_message .= "Name contains invalid characters.<br>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message .= "Please enter a valid email address.<br>";
        }

        if (!preg_match("/^[0-9]{10}$/", $phoneNo)) {
            $phoneNoErr = "Please enter a 10-digit phone number.";
        }

        if (empty($error_message)) {
            // if all fields are valid, process the form
            $to = 'jacktvicari@gmail.com';
            $subject = $formtype;
            $message = "Contact information:\n";
            $message .= "Phone: " . $phoneNo . "\n";
            $message .= "Email: " . $email . "\n";
            $headers = "From: thankyou\r\n";
            $headers .= "Cc: jacktvicari@gmail.com\r\n";
            // send email
            if (mail($to, $subject, $message, $headers)) {
                $success_message = "Thank you for filling out our form!";
                header("Location: login.php?success_message=$success_message");
                
            } else {
                echo "ERROR. Please try again later.";
            }
        }
    }
}
