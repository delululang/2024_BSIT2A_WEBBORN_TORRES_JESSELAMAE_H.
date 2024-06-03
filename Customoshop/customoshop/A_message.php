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

// open messages
$open_messages = "SELECT m.message_id, m.message, m.date_sent,u.user_id, u.user_name FROM messages AS m
                            JOIN users AS u ON m.user_id = u.user_id WHERE m.status = 'open'
                            ORDER BY m.date_sent ASC";
$result_open_messages = mysqli_query($conn, $open_messages);

// closed messages
$closed_messages = "SELECT m.message_id, m.message, m.date_sent, u.user_id, u.user_name, r.reply_text FROM messages AS m
                              JOIN users AS u ON m.user_id = u.user_id JOIN admin_replies AS r ON m.message_id = r.message_id
                              WHERE m.status = 'closed' ORDER BY m.date_sent DESC";
$result_closed_messages = mysqli_query($conn, $closed_messages);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <link rel="stylesheet" href="Style/Amessage.css">
</head>
<body>
<a href="admin.php">Go Back</a>  
<div class="message-container">
    <h2>Open Messages from Users</h2>
    <?php while ($message = mysqli_fetch_assoc($result_open_messages)) { ?>
        <div class="message">
            <div class="username"><?php echo htmlspecialchars($message['user_name']); ?>:</div>
            <div class="text"><?php echo htmlspecialchars($message['message']); ?></div>
            <div class="timestamp"><?php echo $message['date_sent']; ?></div>
            <form class="reply-form" action="A_message_process.php" method="post">
                <textarea name="reply_text" required></textarea>
                <input type="hidden" name="message_id" value="<?php echo $message['message_id']; ?>">
                <input type="hidden" name="user_id" value="<?php echo $message['user_id']; ?>">
                <input type="submit" value="Reply">
            </form>
        </div>
    <?php } ?>
</div>

<div class="message-container">
    <h2>Closed Messages</h2>
    <?php while ($message = mysqli_fetch_assoc($result_closed_messages)) { ?>
        <div class="message closed-message">
            <div class="username"><?php echo htmlspecialchars($message['user_name']); ?>:</div>
            <div class="text"><?php echo htmlspecialchars($message['message']); ?></div>
            <div class="timestamp"><?php echo $message['date_sent']; ?></div>
            <div class="reply-text">Reply: <?php echo htmlspecialchars($message['reply_text']); ?></div>
            <form action="delete_message.php" method="post">
                <input type="hidden" name="message_id" value="<?php echo $message['message_id']; ?>">
                <input type="submit" class="delete-button" value="Delete">
            </form>
        </div>
    <?php } ?>
</div>      
</body>
</html>