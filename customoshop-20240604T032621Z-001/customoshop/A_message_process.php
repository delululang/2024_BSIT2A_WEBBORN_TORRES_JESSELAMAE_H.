<?php
session_start();
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "customoshop(1)";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'A') {
    header("location: login.php");
    exit();
}

$admin_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_text'])) {
    $reply_text = mysqli_real_escape_string($conn, $_POST['reply_text']);
    $message_id = mysqli_real_escape_string($conn, $_POST['message_id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    $sql_insert_reply = "INSERT INTO admin_replies (message_id, user_id, admin_id, reply_text) 
                         VALUES ('$message_id', '$user_id', '$admin_id', '$reply_text')";
    if (mysqli_query($conn, $sql_insert_reply)) {
        // Update message status to 'closed'
        $sql_update_message = "UPDATE messages SET status = 'closed' WHERE message_id = '$message_id'";
        mysqli_query($conn, $sql_update_message);
        
        header("location: A_message.php");
        exit();
    } else {
        echo "Error: " . $sql_insert_reply . "<br>" . mysqli_error($conn);
    }
}
?>