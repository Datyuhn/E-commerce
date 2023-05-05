<?php
session_start();
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
if (count($_POST) > 0) {
    $product = $_POST['keyword'];
    $result = mysqli_query($con, "SELECT * FROM product 
    WHERE CategoryID LIKE '%$product%' OR ProductID LIKE '%$product%' OR ProductName LIKE '%$product%'                     
    ORDER BY ProductID ");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Chi Tiết Kho Hàng </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="product_box">
            <div class="cardHeader">
                <h2>Kho</h2>
            </div>
            <div class="border_bottom"></div>
            <form action="search_product.php" class="search-form" method="post">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box">
                <button type="submit" class="fa fa-search">
            </form>
            <a href="manage_category.php">
                <button type="button" class="button button2"><i class="fa fa-arrow-circle-left"> Quay Lại</i></button>
            </a>
            <table width="100%">
                <thead>
                    <tr>
                        <th>Phân Loại</th>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Size</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {

                ?>
                    <tbody>
                        <tr>
                            <th><?php echo $row['CategoryID']; ?></th>
                            <th><?php echo $row['ProductID']; ?></th>
                            <th><?php echo $row['ProductName']; ?></th>
                            <th><?php echo $row['Size']; ?></th>
                            <th><?php echo $row['Price']; ?></th>
                            <th><?php echo $row['ProductQuantity']; ?></th>
                        </tr>
                    </tbody>
                <?php $i++;
                } ?>
            </table>
        </div>
    </div>
</body>

</html>