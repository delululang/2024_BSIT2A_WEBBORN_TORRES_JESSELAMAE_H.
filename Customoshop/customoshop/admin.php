<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "customoshop(1)";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    session_start();
    if($_SESSION['user_type'] != 'A'){
        header("location: login.php");
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header("location: login.php");
        die();
    }

    if(isset($_GET['Manage Menu'])){
    header("location: add_item.php");}

    if(isset($_GET['Sales Report'])){
        header("location: sales.php");}

    if(isset($_GET['Messages'])){
    header("location: A_message.php");}

    if(isset($_GET['Feedbacks'])){
    header("location: A_feedback.php");}
    

    $s_user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_status = mysqli_real_escape_string($conn, $_POST['order_status']);
    $order_price = mysqli_real_escape_string($conn, $_POST['order_price']);

    $update_order = "UPDATE orders SET order_status='$order_status', price='$order_price' WHERE order_id='$order_id'";
    mysqli_query($conn, $update_order);
}

$getorders = "SELECT o.order_id, m.item_name, o.item_qty, o.product_desc, o.order_status, o.price, u.fullname
                       FROM orders AS o
                       JOIN Products AS m ON o.item_id = m.item_id
                       JOIN users AS u ON o.user_id = u.user_id";
$order_results = mysqli_query($conn, $getorders);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="Style/admin.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="add_item.php">Manage Menu</a></li>
            <li><a href="sales.php">Sales Report</a></li>
            <li><a href="A_message.php">Messages</a></li>
            <li><a href="A_feedback.php">Feedbacks</a></li>
            <li><a href="?logout">logout</a></li>
        </ul>
    </nav>
</header>

<h2>All Orders</h2>

<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>ADesign</th>
        <th>Status</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php while($order = mysqli_fetch_assoc($order_results)) { ?>
        <tr>
            <form action="" method="POST">
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['fullname']; ?></td>
                <td><?php echo $order['item_name']; ?></td>
                <td><?php echo $order['item_qty']; ?></td>
                <td><?php echo $order['design_desc']; ?></td>
                <td>
                    <input type="text" name="order_status" value="<?php echo $order['order_status']; ?>" required>
                </td>
                <td>
                    <input type="text" name="order_price" value="<?php echo $order['price']; ?>" required>
                </td>
                <td>
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <input type="submit" name="update_order" value="Update" id="update">
                </td>
            </form>
        </tr>
    <?php } ?>
</table>
            

</body>
</html>