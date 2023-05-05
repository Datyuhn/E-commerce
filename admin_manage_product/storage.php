<?php
include('../database/dbcon.php');
include '../header_footer/admin_header.php';



?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Menu </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="product_box">
            <div class="cardHeader">
                <h2>Menu</h2>
            </div>
            <div class="border_bottom"></div>
            <!-- search bõ -->
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
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <?php
                // $i = 1;
                try {
                    $pdo = new PDO(
                        "mysql:host=$sname;dbname=$db_name",
                        $uname,
                        $password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                    );
                } catch (Exception $ex) {
                    exit($ex->getMessage());
                }

                // (B) TOTAL NUMBER OF PAGES
                define("PER_PAGE", "10"); // ENTRIES PER PAGE
                $stmt = $pdo->prepare("SELECT CEILING(COUNT(*) / " . PER_PAGE . ") `pages` FROM `product`");
                $stmt->execute();
                $pageTotal = $stmt->fetchColumn();

                // (C) GET ENTRIES FOR CURRENT PAGE
                // (C1) LIMIT (X, Y) FOR SQL QUERY
                $pageNow = isset($_GET["page"]) ? $_GET["page"] : 1;
                $limX = ($pageNow - 1) * PER_PAGE;
                $limY = PER_PAGE;
                $all_products = mysqli_query($con, "SELECT * FROM product ORDER BY CreateDate DESC LIMIT $limX, $limY");

                mysqli_close($con);

                while ($row = mysqli_fetch_array($all_products)) {

                ?>
                    <tbody>
                        <tr>
                            <th><?php echo $row['ProductID']; ?></th>
                            <th><?php echo $row['ProductName']; ?></th>
                            <th><?php echo $row['ProductQuantity']; ?></th>
                            <th><?php echo number_format($row['Price']); ?></th>
                        </tr>
                    </tbody>
                <?php
                } ?>
            </table>

            <div class="pagination" id="pagination">
                <?php

                for ($i = 1; $i <= $pageTotal; $i++) {
                    printf(
                        "<a %shref='storage.php?page=%s'>%s</a> ",
                        $i == $pageNow ? "class='current' " : "",
                        $i,
                        $i
                    );
                }

                ?>
            </div>
        </div>


    </div>
</body>


</html>