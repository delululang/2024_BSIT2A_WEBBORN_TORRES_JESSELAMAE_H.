<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "customoshop(1)";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

session_start();

if ($_SESSION['user_type'] != 'A') {
    header("location: login.php");
}

// to get data
$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 day'));
$this_year = date('Y');
$last_year = date('Y', strtotime('-1 year'));

// sales for today
$sales_today = "SELECT SUM(price) AS total_sales_today FROM orders WHERE DATE(time_ordered) = '$today'";
$result_today = mysqli_query($conn, $sales_today);
$total_sales_today = mysqli_fetch_assoc($result_today)['total_sales_today'] ?? 0;

// sales yesterday
$sales_yesterday = "SELECT SUM(price) AS total_sales_yesterday FROM orders WHERE DATE(time_ordered) = '$yesterday'";
$result_sales_yesterday = mysqli_query($conn, $sales_yesterday);
$total_sales_yesterday = mysqli_fetch_assoc($result_sales_yesterday)['total_sales_yesterday'] ?? 0;

// sales this year
$sales_this_year = "SELECT SUM(price) AS total_sales_this_year FROM orders WHERE YEAR(time_ordered) = '$this_year'";
$result_sales_this_year = mysqli_query($conn, $sales_this_year);
$total_sales_this_year = mysqli_fetch_assoc($result_sales_this_year)['total_sales_this_year'] ?? 0;

// sales last year
$sales_last_year = "SELECT SUM(price) AS total_sales_last_year FROM orders WHERE YEAR(time_ordered) = '$last_year'";
$result_sales_last_year = mysqli_query($conn, $sales_last_year);
$total_sales_last_year = mysqli_fetch_assoc($result_sales_last_year)['total_sales_last_year'] ?? 0;

// for top 10 items
$sql_top_items = "SELECT m.item_name, SUM(item_qty) AS total_quantity 
                  FROM orders AS oi
                  JOIN Products AS m ON oi.item_id = m.item_id
                  GROUP BY oi.item_id
                  ORDER BY total_quantity DESC
                  LIMIT 10";
$result_top_items = mysqli_query($conn, $sql_top_items);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales</title>
    <link rel="stylesheet" href="Style/sales.css">
</head>
<body>

    <a href="admin.php">Go Back</a>
    <div class="report-section">
        <h2>Sales Report</h2>
        <table id="table_one">
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Total Sales Today</td>
                <td><?php echo "Php " . number_format($total_sales_today, 2); ?></td>
            </tr>
            <tr>
                <td>Total Sales Yesterday</td>
                <td><?php echo "Php " . number_format($total_sales_yesterday, 2); ?></td>
            </tr>
            <tr>
                <td>Total Sales This Year</td>
                <td><?php echo "Php " . number_format($total_sales_this_year, 2); ?></td>
            </tr>
            <tr>
                <td>Total Sales Last Year</td>
                <td><?php echo "Php " . number_format($total_sales_last_year, 2); ?></td>
            </tr>
        </table>
    </div>

    <div class="report-section">
        <h3>Top 10 Items</h3>
        <table id="table_two">
            <tr>
                <th>Item Name</th>
                <th>Quantity Sold</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result_top_items)) { ?>
            <tr>
                <td><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['total_quantity']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>


</body>
</html>