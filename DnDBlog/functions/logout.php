<?php

session_start();

// destroy session data
$_SESSION = array();
session_destroy();

// redirect to login page
$success_message = "Logout Success!";
// Redirect to the login page
header("Location: ./../login.php?success_message=$success_message");
exit();
