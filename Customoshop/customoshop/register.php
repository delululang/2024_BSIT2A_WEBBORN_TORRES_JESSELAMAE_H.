<!DOCTYPE html>
<html>

    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Registration </title>
        <link rel="stylesheet" href="Style/register.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body>
        <div class="wrapper">
            <form action="register_process.php" method="post">
                <h1>Registration</h1>

                <div class="input-box">
                    <div class="input-field">
                        <input type="text" name = "FullName" placeholder="FullName"
                        required>
                        <i class='bx bxs-user'></i>
                        
                    </div>

                    <div class="input-field">
                        <input type="text" name = "Username" placeholder="Username"
                        required>
                        <i class='bx bxs-user'></i>
                    </div>
                </div>
                
                <div class="input-box">
                    <div class="input-field">
                        <input type="email" name = "Email" placeholder="Email"
                        required>
                        <i class='bx bxs-envelope'></i>
                    </div>

                    <div class="input-field">
                        <input type="text" name = "PhoneNumber" placeholder="Phone Number"
                        required>
                        <i class='bx bxs-phone'></i>
                    </div>
                </div>

                <div class="input-box" id="password">
                    <div class="input-field">
                        <input type="password" name = "Password" placeholder="Password" 
                        required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                </div>
                <div class="links">
                    <p>Already have an Account?<a href="login.php"> Login</p>
                    <p><a href="home.php">Go to Home</p>
                </div>
                <a href="login.php">
                <button type="submit" class="btn">Register</button></a>
            </form>

      </div>


    </body>
    </html>