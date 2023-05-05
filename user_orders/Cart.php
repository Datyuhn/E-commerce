<?php
session_start();
include('../database/dbcon.php');
include('../header_footer/user_header.php');
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sumSP = 0;
    $sumTien = 0;
?>

    <html>

    <head>
        <!-- <title>Giỏ hàng</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../scss/user.css?v=<?php echo time(); ?>">-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

        <title>Giỏ hàng</title>
        <style>
            .small-container {
                margin: 80px 120px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            .cart-info {
                display: flex;
                flex-wrap: wrap;
            }

            th {
                margin: 5px;
                text-align: center;
                padding: 15px;
                color: white;
                background: #fb5849;
            }

            td {
                padding: 10px 5px;
            }

            td input {
                width: 40px;
                height: 30px;
                padding: 5px;
            }

            td a {
                color: #fb5849;
                font-size: 12px;
            }

            td img {
                width: 30%;
                height: auto;
                margin-right: 10px;
                /* object-fit: cover; */
            }

            .total-price {
                display: flex;
                justify-content: flex-end;
            }

            .total-price table {
                border-top: 3px solid #fb5849;
                width: 100%;
                max-width: 350px;
            }

            td:last-child {
                text-align: center;
            }

            th:last-child {
                text-align: right;
            }

            .buy {
                background-color: #fb5849;
                border: none;
                margin: 4px 2px;
                font-size: 16px;
                padding: 15px 32px;
                color: white;
            }
        </style>

        <!-- Additional CSS Files -->
        <!-- <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">
        <link rel="stylesheet" href="/assets/css/templatemo-klassy-cafe.css">
        <link rel="stylesheet" href="/assets/css/owl-carousel.css">
        <link rel="stylesheet" href="/assets/css/lightbox.css"> -->
        <!-- <link rel="stylesheet" href="/assets/scss/gioHang.css"> -->
    </head>

    <body>
        <div>
            <?php include '../header_footer/admin_toggle.php'; ?>
        </div>
        <section class="section" id="offers">
            <div class="small-container">
                <table>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                    </tr>
                    <?php
                    $i = 1;
                    $s = "SELECT * FROM `Cart` 
                        where AccountID = '$id'";

                    $Quantity = mysqli_query($con, $s);
                    while ($row = mysqli_fetch_array($Quantity)) {
                        $s1 = $row['ProductID'];
                        $product = "SELECT * FROM `categories` 
                            where CategoryID = '$s1'";
                        $product1 = mysqli_query($con, $product);
                        $product = mysqli_fetch_assoc($product1);
                    ?>
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <!-- <img src="../assets/images/Cơm chiên xúc xích.jpg" alt=""> -->
                                    <?php
                                    $img =  "../assets/images/" . $product['ThumbnailImage'];
                                    ?>
                                    <img src="<?php echo $img ?>">
                                    <div>
                                        <p>
                                            <?php
                                            $name =  $product['CategoryName'];
                                            echo $name
                                            ?>
                                        </p>
                                        <small>Giá: <?php
                                                        $produc = mysqli_query($con, "SELECT * FROM `product` 
                            where CategoryID = '$s1'");
                                                        $product = mysqli_fetch_array($produc);
                                                        $cost =  $product['Price'];
                                                        $ProductQuantity = $row['ProductQuantity'];
                                                        $price = $cost;
                                                        echo $price;

                                                        ?></small>
                                        <br>
                                        <a href="../pay/delete.php?id=<?php echo $id ?>&cid=<?php echo $s1; ?>" onclick='return checkdelete()'>
                                            Loại bỏ
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input type="number" value="<?php
                                                            $ProductQuantity =  $row['ProductQuantity'];
                                                            echo $ProductQuantity
                                                            ?>">
                            </td>
                            <td>
                                <?php
                                $produc = mysqli_query($con, "SELECT * FROM `product` 
                            where CategoryID = '$s1'");
                                $product = mysqli_fetch_array($produc);
                                $cost =  $product['Price'];
                                $ProductQuantity = $row['ProductQuantity'];
                                $price = $cost * $ProductQuantity;
                                echo $price;
                                $sumSP += $ProductQuantity;
                                $sumTien += $price;
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <br>
                <div class="total-price">
                    <table>
                        <tr>
                            <td>Tổng sản phẩm</td>
                            <td><?php echo $sumSP; ?></td>
                        </tr>
                        <tr>
                            <td>Tổng</td>
                            <td><?php echo $sumTien ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="pay.php?id=<?php echo $id ?>&&sp=<?php echo $sumSP ?>&&tien=<?php echo $sumTien ?>">
                                    <button type="button" id="delete" class="buy">Thanh toán</button>
                                </a>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </section>
    </body>
    <div>
        <?php include('../header_footer/footer.php');
        ?>
    </div>

    </html>
<?php
} else {
    header("Location: ../user_account/login.php");
    exit();
}
?>