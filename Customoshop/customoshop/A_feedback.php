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

?>
<html>
    <head>
        <title>Feedback</title>
        <link rel="stylesheet" href="A_feedback.css" >
    </head>
    <body>
    <a href="admin.php">Go Back</a> 
    <br>
    <br>
    <h2>Feedback</h2>
    <table border="1"; class="feedback">
    <tr>
        <th>User ID</th>
        <th>Feedback ID</th>
        <th>Comment</th>
        <th>Rating</th>
        <th>Date</th>
    </tr>
    <?php
    $feedbacks = "SELECT * FROM `feedbacks`";
    $result = mysqli_query($conn, $feedbacks);
    while ($feedback = mysqli_fetch_assoc($result)) { 
        ?>
        <tr>
            <td id="user_id"><?php echo $feedback['user_id']; ?></td>
            <td id="feedback_id"><?php echo $feedback['feedback_id']; ?></td>
            <td id="comment"><?php echo $feedback['comment']; ?></td>
            <td id="rating"><?php echo $feedback['rating']; ?></td>
            <td id="feedback_date"><?php echo $feedback['feedback_date']; ?></td>
        </tr>
    <?php } ?>
</table>
    </body>
</html>