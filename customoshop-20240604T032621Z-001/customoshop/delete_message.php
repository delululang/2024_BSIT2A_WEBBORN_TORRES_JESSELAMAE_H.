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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message_id'])) {
    $message_id = mysqli_real_escape_string($conn, $_POST['message_id']);
    
    // Delete the reply first
    $sql_delete_reply = "DELETE FROM admin_replies WHERE message_id = '$message_id'";
    mysqli_query($conn, $sql_delete_reply);
    
    // Then delete the message
    $sql_delete_message = "DELETE FROM messages WHERE message_id = '$message_id'";
    if (mysqli_query($conn, $sql_delete_message)) {
        header("location: A_message.php");
        exit();
    } else {
        echo "Error: " . $sql_delete_message . "<br>" . mysqli_error($conn);
    }
}
?>