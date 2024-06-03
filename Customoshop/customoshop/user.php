<?php
    
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customoshop(1)";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    session_start();

    if($_SESSION['user_type'] != 'C'){
        header("location: login.php");
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header("location: login.php");
        die();
    }
    if(isset($_GET['Feedback'])){
        header("location: feedback.php");
    }
    if(isset($_GET['Order'])){
        header("location: order.php");
    }
    if(isset($_GET['Message'])){
        header("location: message.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>CustomoShop</title>
    <link rel="stylesheet" href="Style/user.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li>Welcome, <?php echo $_SESSION['fullname']; ?></li>
            <li><a href="order.php">Order</a></li>
            <li><a href="message.php">Message</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="?logout">logout</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Welcome to Customoshop</h2>
    <br>
    <div class="products">
        <?php
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="Products">';
                echo '<img src="' . $row["image_path"] . '" alt="' . $row["item_name"] . '">';
                echo "<h3>" . $row["item_name"] . "</h3>";
                echo "<p>" . $row["price"] . " Pesos</p>";
                echo '</div>';
            }
        } 
        else {
            echo "0 results";
        }
        ?>
    </div>
</div>

</body>
</html>