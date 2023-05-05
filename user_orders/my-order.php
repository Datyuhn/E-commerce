<?php
session_start();
include('../database/dbcon.php');
include('../header_footer/user_header.php');
?>
<html>

<head>
    <title>Đơn của tôi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        /* table {
            
        }

        .row-number:before {
            counter-increment: row-number;
            content: counter(row-number);
        } */
        .smart-container {
            margin: 80px 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            counter-reset: row-number;
        }

        th {
            margin: 5px;
            text-align: center;
            padding: 15px;
            color: white;
            background: #ff523b;
        }

        td {
            padding: 10px 5px;
        }

        th:last-child,
        .order-info {
            text-align: center;
        }

        td:last-child {
            text-align: center;
        }

        .row-number:before {
            counter-increment: row-number;
            content: counter(row-number);
        }
    </style>
</head>

<body>
    <section class="section" id="offers">
        <div class="smart-container">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Đơn hàng đã đặt</h6>
                </div>
            </div>
            <div>
                <table>
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Mã Đơn</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Tổng tiền</th>
                    </tr>
                    <?php
                    $s = "SELECT Count(*) AS ProductQuantity FROM `Product`";
                    $result = mysqli_query($con, $s);
                    $sp = mysqli_fetch_assoc($result);
                    $result = mysqli_query($con, "SELECT Count(*) AS ProductQuantity FROM `Order`");
                    $dh = mysqli_fetch_assoc($result);
                    ?>

                    <tr>
                        <?php
                        $id = $_SESSION['id'];
                        $product = "SELECT o.*, od.OrderDate
                                FROM `Order` o
                                JOIN Order_Details od ON o.OrderID = od.OrderID
                                WHERE od.AccountID = '$id'
                                GROUP BY OrderID
                                ORDER BY od.OrderDate DESC;";
                        $all_products = mysqli_query($con, $product);
                        //retreat data from the previous query
                        while ($row = mysqli_fetch_array($all_products)) {
                            $code = strtoupper($row['OrderID']);
                        ?>
                            <td class="order-info row-number"><a href='order-details.php'></a></td>
                            <td class="order-info"><a href='order-details.php' style="color: black; font-weight: bold"><?php echo $code; ?></a></td>
                            <td class="order-info"><?php echo $row['OrderDate']; ?></td>
                            <td class="order-info"><?php echo $row['Cost']; ?></td>

                    </tr>
                <?php } ?>
                </table>
            </div>
        </div>
    </section>
</body>

</html>