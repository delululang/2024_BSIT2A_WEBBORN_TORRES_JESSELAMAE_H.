<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "customoshop(1)";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

session_start();
if ($_SESSION['user_type'] != 'C') {
    header("location: login.php");
    exit(); // Stop further execution
}

$s_user_id = $_SESSION['user_id'];

if (isset($_GET['delete_from_cart'])) {
    $order_id = $_GET['delete_from_cart'];
    $delete_cart = "DELETE FROM orders WHERE order_id = '$order_id'";
    $sql_execute = mysqli_query($conn, $delete_cart);
    if ($sql_execute) {
        header("location: order.php?msg=cart_item_removed");
        exit(); // Stop further execution
    }
}

if (isset($_GET['cart_qty']) && isset($_GET['designs']) && isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
    $cart_qty = $_GET['cart_qty'];
    $designs = $_GET['designs'];

    // Insert the order into the database
    $insert_order = "INSERT INTO orders (user_id, item_id, item_qty, product_desc, order_status, price) 
                     VALUES ('$s_user_id', '$item_id', '$cart_qty', '$designs', 'Order Placed', (SELECT price FROM products WHERE item_id = '$item_id') * '$cart_qty')";
    $insert_result = mysqli_query($conn, $insert_order);
    if ($insert_result) {
        header("location: order.php?msg=order_placed");
        exit(); // Stop further execution
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$sql_get_orders = "SELECT o.order_id, m.item_name, o.item_qty, o.product_desc, o.order_status, o.price
                    FROM orders AS o
                    JOIN products AS m ON o.item_id = m.item_id
                    WHERE o.user_id = '$s_user_id'";
$order_results = mysqli_query($conn, $sql_get_orders);
?>

<html>
<head>
    <title> Order </title>
    <link rel="stylesheet" href="style/order.css">
</head>
<body>

<div class="header">
    <h2 id="place_order">Place Your Order</h2>
    <nav>
        <ul>
            <li><a href="user.php">Home</a></li>
        </ul>
    </nav>
</div>
<table class="designs">
    <tr>
        <th>designs</th>
        <th>Price</th>
    </tr>
    <?php
    $get_design = "SELECT * FROM `designs`";
    $design_result = mysqli_query($conn, $get_design);
    while ($design = mysqli_fetch_assoc($design_result)) {
        ?>
        <tr>
            <td><?php echo $design['design_name']; ?></td>
            <td><?php echo "Php " . number_format($design['design_pricing'], 2); ?></td>
        </tr>
    <?php } ?>
</table>
<table class="table">
    <?php
    $get_items = "SELECT * FROM `products`";
    $get_result = mysqli_query($conn, $get_items);
    while ($row = mysqli_fetch_assoc($get_result)) { ?>
        <tr>
            <td id="item"><?php echo $row['item_name']; ?></td>
            <td><?php echo "Php " . number_format($row['price'], 2); ?></td>
            <td>

                <form action="order.php" method="get">
                    <div class="input-group">
                        <input type="text" hidden class="form-control" name="item_id" value="<?php echo $row['item_id']; ?>">
                        <input type="number" class="form-control" name="cart_qty">
                        <label for="comment">Designs:</label>
                        <textarea id="comment" name="designs" rows="4"></textarea>
                        <input type="submit" value="Order" class="btn btn-primary">
                    </div>
                </form>
            </td>
        </tr>
    <?php }
    ?>
</table>

<div class="status">
    <?php
    if (mysqli_num_rows($order_results) > 0) { ?>

        <h2>My Order Status</h2>

        <table border="1" class="order">
            <tr>
                <th>Order ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Product Description</th>
                <th>Status</th>
                <th>Price</th>
            </tr>
            <?php while ($order = mysqli_fetch_assoc($order_results)) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['item_name']; ?></td>
                    <td><?php echo $order['item_qty']; ?></td>
                    <td><?php echo $order['product_desc']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['price']; ?></td>
                    <td>
                        <?php if ($order['order_status'] == 'Order Placed') { ?>
                            <a href="?delete_from_cart=<?php echo $order['order_id']; ?>" class="cancel">Cancel</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }
    } else { ?>
        <p>Your cart is currently empty.</p>
    <?php } ?>
    </table>
    <div class="warn">
        <p>User will not be able to cancel their order if the seller receives it already
            (Order status will change to "Order Received" and so on)
        </p>
    </div>
</div>

</body>
</html>
