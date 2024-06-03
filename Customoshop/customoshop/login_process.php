<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "customoshop(1)";
$db_conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

session_start();
$username = $_POST["Uname"];
$password = $_POST["password"];


$sql = "SELECT * FROM users WHERE user_name = '$username' AND password = '$password'";
$result = mysqli_query($conn,$sql);
$count_result = mysqli_num_rows($result);

if ($count_result == 1) {

    $row = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['user_name'];
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phone_number'] = $row['phone_number'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['user_type'] = $row['usertype'];

    if($row['usertype'] == 'C'){
        header("location: user.php");
    }
    else if($row['usertype'] == 'A'){
        header("location: admin.php");
    }
   
} else {
    header("Location: login.php?error=1");
    exit();
}

?>
