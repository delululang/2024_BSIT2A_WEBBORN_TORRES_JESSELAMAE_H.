
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            background-image: url("background1.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }
        
        .top-design, .bottom-design {
            background-color: saddlebrown;
            height: 50px;
            opacity: 0.8;
            position: fixed;
            width: 100%;
            left: 0;
        }
        
        .top-design {
            top: 0;
        }
        
        .bottom-design {
            bottom: 0;
        }
        
        .container {
            width: 300px;
            padding: 16px;
            background-color: saddlebrown;
            margin: 0 auto;
            margin-top: 100px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            opacity: 0.9;
        }
        
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        
        button {
            background-color: saddlebrown;
            color: khaki;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 1.0;
        }
        
        button:hover {
            opacity: 0.8;
        }
        
        .container label {
            color: khaki;
        }
        
        .container span {
            float: right;
            padding-top: 16px;
        }
        
        .container span a {
            color: khaki;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="top-design"></div>
    <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <button type="submit" onclick="redirectToOrderPage()">Login</button>
        <span><a href="#">Forgot password?</a></span>
        <span><a href="#">Don't have an account? Sign up</a></span>
    </div>
    <div class="bottom-design"></div>

    <script>
        function redirectToOrderPage() {
            // Redirect to the order page
            window.location.href = "order.php";
        }
    </script>
</body>
</html>