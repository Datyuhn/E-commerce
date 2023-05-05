<?php
include('../database/dbcon.php');
include '../header_footer/admin_header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sản Phẩm </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <title>Đơn Hàng</title>
    <!-- show content  -->
    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="product_box">
            <div class="cardHeader">
                <h2>Đơn Hàng</h2>
            </div>
            <div class="border_bottom"></div>
            <table width="100%">
                <thead>
                    <tr>
                        <?php
                        $s = "SELECT Count(*) AS ProductQuantity FROM `Product`";
                        $result = mysqli_query($con, $s);
                        $sp = mysqli_fetch_assoc($result);
                        $result = mysqli_query($con, "SELECT Count(*) AS ProductQuantity FROM `Order`");
                        $dh = mysqli_fetch_assoc($result);
                        ?>
                        <th>Mã Đơn</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <?php
                $product = "SELECT * FROM `Order`";
                $all_products = mysqli_query($con, $product);
                //retreat data from the previous query
                while ($row = mysqli_fetch_array($all_products)) {
                    $code = strtoupper($row['OrderID']);
                ?>
                    <th><?php echo $code; ?></th>
                    <th><?php echo $row['Total']; ?></th>
                    <th><?php echo $row['Cost']; ?></th>
                    <th>
                        <a href="../order/orderdetails.php?ido=<?php echo $row['OrderID'] ?>&&sl=<?php echo $row['Total'] ?>&&cost=<?php echo $row['Cost'] ?>">
                            <button type="button" class="fa fa-eye"></button></a>
                        </a>
                    </th>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <script>
        function checkdelete() {
            return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
        }
    </script>
</body>

</html>