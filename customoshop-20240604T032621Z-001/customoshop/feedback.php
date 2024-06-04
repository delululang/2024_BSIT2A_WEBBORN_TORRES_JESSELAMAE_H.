<!DOCTYPE html>
<html>
    <?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customoshop(1)";
    $db_conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    session_start();

    if($_SESSION['user_type'] != 'C'){
        header("location: login.php");
    }
    ?>
<head>
    <title>Feedback</title>
    <link rel="stylesheet" href="Style/feedback.css">
</head>
<body>

<div class="container">
    <h2>Feedback </h2>
    <form action="submit.php" method="post">
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
        <br>
        <label for="comment" id="comment">Comment:</label>
        <br>
        <br>
        <label for="rating" id="Rating">Rating:</label>
        <select id="rating" name="rating" required>
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select>
        <br>
        <br>
        <br>
        <button type="submit" id="submit">Submit</button>
        <br>
        <a href="user.php" id="cancel">Cancel</a>
    </form>
</div>

</body>
</html>

