<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit_form'])) {
        echo "test";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $formType = $_POST['formType'];


        // check inputs
        if (!preg_match("/^([a-zA-Z' ]+)$/", $firstname) || !preg_match("/^([a-zA-Z' ]+)$/", $lastname)) {
            $error_message .= "Name contains invalid characters.<br>";
            echo $error_message;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message .= "Please enter a valid email address.<br>";
            echo $error_message;
        }

        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $error_message .= "Please enter a 10-digit phone number.";
            echo $error_message;
        }

        if (empty($error_message)) {

            echo "no errors here buddy!";
            // if all fields are valid, process the form
            $to = 'jacktvicari@gmail.com';
            $subject = $_GET['formType'];
            $message = "Contact information:\n";
            $message .= "Phone: " . $phone . "\n";
            $message .= "Email: " . $email . "\n";
            $headers = "From: thankyou\r\n";
            $from = 'jacktvicari@gmail.com';
            $headers .= "Cc: jacktvicari@gmail.com\r\n";
            $cc = $_GET['CCAddress'];
            // send email

            foreach ($_POST as $key => $val) {
                if (is_array($val)) {
                    $message .= "$key:\n" . join(", ", $val) . "\n\n";
                } else {
                    $message .= "$key:\n $val\n\n";
                }
            }
            if ($cc == "") {
                $addresses = "From: $from";
            } else {
                $addresses = "From: $from \r\nCC: $cc";
            }

            // Display the thankyou message
            //if (mail($to, $subject, $message, $headers)) {
            if (empty($error_message)) {
                $success_message = "Thank you for filling out our form!";
                header("Location: /DnDBlog/main.php?success_message=$success_message");
            }
        } else {
            // Display the error message
            $success_message  = "Error! We're sorry but your message could not be sent.";

            header("Location: /DnDBlog/contact.php?formType=$formType&success_message=$success_message&error_message=$error_message");
        }
    }
}
