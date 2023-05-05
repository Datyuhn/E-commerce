<?php
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
if (isset($_GET['ido'])) {
    $id = $_GET['ido'];
    $tongtien = $_GET['cost'];
    $slsp = $_GET['sl'];
    $s = "SELECT * FROM `Order_Details` 
    where OrderID = '$id'";
    $sl = mysqli_query($con, $s);
    $row = mysqli_fetch_array($sl);
    $name = $row['CustomerName'];
    $phone = $row['CustomerPhoneNo'];
    $address = $row['CustomerAddress'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chi tiết đơn hàng</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <title>Hóa đơn</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
            }
        </style>
        <title>Thông Tin Đơn Hàng</title>
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
                    <h2>Thông Tin Đơn Hàng</h2>
                </div>
                <div class="border_bottom"></div>
                <div>Họ Và Tên: <?php echo $name ?></div>
                <div>Địa Chỉ: <?php echo $address ?></div>
                <div>Số điện Thoại: <?php echo $phone ?></div>
                <div class="border_bottom"></div>
                <table width="100%">
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>
                    <?php
                    //initialise variable
                    //thực hiện query trong database

                    $i = 1;
                    //retreat data from the previous query
                    $s = "SELECT * FROM `Order_Details` 
                    where OrderID = '$id'";
                    $sl = mysqli_query($con, $s);
                    while ($row = mysqli_fetch_array($sl)) {
                        //check if the product is still available
                        //lấy id giày
                        $s1 = $row['ProductID'];
                        $products = "SELECT * FROM `Categories` 
                        where CategoryID = '$s1'";
                        $product1 = mysqli_query($con, $products);
                        $product = mysqli_fetch_assoc($product1);
                    ?>
                        <th><?php
                            //create img path
                            $img =  "../images/" . $product['ThumbnailImage'];
                            ?>
                            <!-- display img -->
                            <img src="<?php echo $img ?>" style="width: 100px;">
                        </th>
                        <th><?php
                            //create img path
                            $name =  $product['CategoryName'];
                            echo $name
                            ?></th>
                        <th><?php
                            //create img path
                            $productquantity =  $row['amount'];
                            echo $productquantity
                            ?></th>
                        <th>
                            <?php
                            $price = $row['Cost'] * $row['amount'];
                            echo $price;
                            ?>
                        </th>
                        </tbody>
                    <?php } ?>
                    <thead>
                        <tr>
                            <th colspan="2">Tổng sản phẩm</th>
                            <th colspan="2">Tổng tiền</th>
                        </tr>
                    </thead>
                    <th colspan="2"><?php echo $slsp; ?></th>
                    <th colspan="2"><?php echo $tongtien ?></th>
                </table>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: ../user_account/login.php");
    exit();
}
?>