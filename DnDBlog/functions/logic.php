<?php

    $conn = mysqli_connect("localhost", "root", "", "BLOG" );

    if(!$conn){
        #debugging
        echo "<h3 class='container bg-dark text-center p-3 text-warning rounded-lg mt-5'>Unable to establish connection to database</h3>";
    }

    if(isset($_POST['make_post']))
    {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $statement = mysqli_prepare($conn, "INSERT INTO posts(title, content, post_time) VALUES (?, ?, NOW())");
        mysqli_stmt_bind_param($statement, "ss", $title, $content);
        mysqli_stmt_execute($statement);

        header("Location: main.php?info=added");
        exit();
    }   
?>