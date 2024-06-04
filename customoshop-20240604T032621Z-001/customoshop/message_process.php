<?php
    session_start();
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customoshop(1)";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'C') {
        header("location: login.php");
        exit();
    }

    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $id = $_SESSION['user_id'];
    $name = $_SESSION['fullname'];
    $url = "user.php";

    $sql = "INSERT INTO `messages`(`user_id`, `fullname`, `message`) VALUES ('$id', '$name', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "Message sent successfully";
        echo '<a href="' . $url . '"> Go Home</a>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    ?>