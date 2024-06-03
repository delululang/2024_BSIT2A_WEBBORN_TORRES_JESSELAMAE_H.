<?php

        $db_server = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "customoshop(1)";
        $db_conn = "";

        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

        $fname = $_POST ["FullName"];
        $uname = $_POST ["Username"];
        $mail = $_POST ["Email"];
        $numb = $_POST ["PhoneNumber"];
        $pass = $_POST ["Password"];

        $check_user = "SELECT * FROM users WHERE `user_name` = '$uname'";

        $result = mysqli_query($conn, $check_user);

        $count_result = mysqli_num_rows($result);

        if($count_result > 0){

        header("location: register.php?error=user_already_exist");
        }
        else {
        //user can register
        $sql_new_user = "INSERT INTO `users`(`user_name`, `fullname`, `email`, `phone_number`, `password`) 
        VALUES ('$uname','$fname','$mail','$numb','$pass')";

        header("Location: login.php");
    
        $execute_query = mysqli_query($conn,$sql_new_user);  
        mysqli_close($conn);
    
}
?>