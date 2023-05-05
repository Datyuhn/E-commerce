<?php
session_start();
include('../database/dbcon.php');
include('../header_footer/user_header.php');
$id = $_SESSION['id'];
$order_id = $_SESSION['orderID'];
echo $order_id;
$order_content = mysqli_query($con, "SELECT * FROM `Order` WHERE AccountID = '$id' && OrderID = '$order_id' ORDER BY OrderDate DESC");
$row = mysqli_fetch_array($order_content);
?>
<html>

<head>
    <title>Bộ Sưu Tập</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../scss/user.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="my-order_box">
        <div class="cardHeader">
            <h2>Đơn Hàng #<?php echo $row['OrderID']; ?></h2>
        </div>
        <div>Thời gian đặt hàng: <?php echo $row['OrderDate']; ?></div>
    </div>
</body>

</html>