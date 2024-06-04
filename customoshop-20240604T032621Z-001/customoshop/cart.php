<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "customoshop(1)";
$db_conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
session_start();

if(isset($_GET['item_id'])){
    $user_id = $_SESSION['user_id'];
    $item_id = $_GET['item_id'];
    $item_qty = $_GET['cart_qty'];
    $add = $_GET['add-on'];
    
    $sql_add_to_cart = "INSERT INTO `orders`
           (`user_id`, `item_id`, `item_qty`, `product_desc`)
           VALUES
           ('$user_id','$item_id','$item_qty', '$add')";
    $execute_cart = mysqli_query($conn, $sql_add_to_cart);
    
    if($execute_cart){
        header("location: order.php?msg=item_{$item_id}_added_to_cart");
    }
}