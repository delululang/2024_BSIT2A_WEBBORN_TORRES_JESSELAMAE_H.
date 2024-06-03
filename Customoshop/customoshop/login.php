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
    
?>
    <head>
        <title> Login </title>
        <link rel="stylesheet" href="Style/login.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body>

        <div class="wrapper">
            <form action="login_process.php" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name ="Uname" placeholder="Username"
                    required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="password" name ="password" placeholder="Password"
                    required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                    <button type="submit" class="btn">Login</button>

                    <div class="register-link">
                        <p>Dont have an Account?<a href="register.php"> Register</p>
                        <br>
                        <p><a href="home.php"> Home</p>
                    </div>

            </form>
        </div>

    </body>

<html>
