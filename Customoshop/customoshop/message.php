<!DOCTYPE html>
<html>
    <?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customoshop(1)";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    session_start();

    if($_SESSION['user_type'] != 'C'){
        header("location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    ?>
<head>
    <title>Message</title>
    <link rel="stylesheet" href="style/message.css">
</head>
<body>

<div class="container">
    <h2>Message</h2>
    <form action="message_process.php" method="post">
        <textarea id="message" name="message" rows="7" cols="50" required></textarea>
        <label for="message">Message seller:</label>
        <button type="submit">Submit</button>
        <br>
        <br>
        <a href="user.php" id="cancel">Cancel</a>
    </form>
    
    <h2>Your Messages:</h2>
    <?php
    $messages = "SELECT m.message_id, m.message, m.date_sent, 
                                  r.reply_text, r.timestamp
                           FROM messages AS m
                           LEFT JOIN admin_replies AS r ON m.message_id = r.message_id
                           WHERE m.user_id = '$user_id'
                           ORDER BY m.date_sent ASC";
    $result_messages = mysqli_query($conn, $messages);

    while ($message = mysqli_fetch_assoc($result_messages)) {
        echo '<div class="message">';
        echo '<div class="text"><strong>You:</strong> ' . htmlspecialchars($message['message']) . '</div>';
        echo '<div class="timestamp">Sent: ' . $message['date_sent'] . '</div>';

        if (!empty($message['reply_text'])) {
            echo '<div class="reply">';
            echo '<div class="text"><strong>Admin:</strong> ' . htmlspecialchars($message['reply_text']) . '</div>';
            echo '<div class="timestamp">Replied: ' . $message['timestamp'] . '</div>';
            echo '</div>';
        }

        echo '</div>';
    }
    ?>
</div>

</body>
</html>