<?php
    
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customoshop(1)";
    $db_conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    session_start();

    $comment = $_POST['comment'];
    $rating = $_POST['rating'];
    $id = $_SESSION['user_id'];
    $url = "user.php";

    $sql = "INSERT INTO `feedbacks`(`user_id`, `comment`, `rating`) VALUES ('$id','$comment','$rating')";

    if (mysqli_query($conn, $sql)) {
        echo "Feedback submitted successfully";
        echo '<a href="' . $url . '"> Go Back</a>';
    }else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

?>