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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_item'])) {
        $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
    
        $sql_insert_item = "INSERT INTO products (item_name, price) VALUES ('$item_name', '$price')";
        mysqli_query($conn, $sql_insert_item);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
        $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    
        $sql_delete_item = "DELETE FROM products WHERE item_id='$item_id'";
        mysqli_query($conn, $sql_delete_item);
    }
    
    $sql_get_all_items = "SELECT * FROM products";
    $item_results = mysqli_query($conn, $sql_get_all_items);
?>
<html>
    <head>
    <title>Menu</title>
    <link rel="stylesheet" href="Style/add_item.css">
    </head>
    <body>
    <a href="admin.php">Go Back</a>
    <h2>Add New Item</h2>
            <form action="add_item.php" method="post">
                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" required><br><br>

                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" required><br><br>

            <input type="submit" name="add_item" value="Add Item" id="add_item">
            </form>
            <h2>Menu Items</h2>
<table>
    <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php while($item = mysqli_fetch_assoc($item_results)) { ?>
        <tr>
            <td><?php echo $item['item_id']; ?></td>
            <td><?php echo $item['item_name']; ?></td>
            <td><?php echo "Php " . number_format($item['price'], 2); ?></td>
            <td>
                <form action="add_item.php" method="POST" style="display:inline;">
                    <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                    <input type="submit" name="remove_item" value="Remove" class="remove-btn">
                </form>
            </td>
        </tr>
    <?php } ?>
</table>


    </body>
</html>