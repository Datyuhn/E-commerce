<?php
session_start();
include('../database/dbcon.php');
include '../header_footer/user_header.php';
// include '../header_footer/user_bar.php';
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Cửa hàng</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/css/templatemo-klassy-cafe.css">
    <link rel="stylesheet" href="/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="/assets/css/lightbox.css">
    <link rel="stylesheet" href="/assets/css/fuser.css">
</head>

<body>
    <section class="section" id="offers">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Cửa hàng</h6>
                </div>
            </div>
            <form action="" method="get">
                <div class="row">
                    <div class="col1">
                        <div class="sort-box">
                            <select name="sort" id="sort" class="form-control">
                                <!-- select sorting option and remember the option when the page is reload -->
                                <option value="new" <?php if (isset($_GET['sort']) && $_GET['sort'] == "new") {
                                                        echo "selected";
                                                    } ?>>Mới Nhất</option>
                                <option value="low" <?php if (isset($_GET['sort']) && $_GET['sort'] == "low") {
                                                        echo "selected";
                                                    } ?>>Giá: Thấp đến Cao</option>
                                <option value="high" <?php if (isset($_GET['sort']) && $_GET['sort'] == "high") {
                                                            echo "selected";
                                                        } ?>>Giá: Cao đến Thấp</option>
                            </select>
                            <button type="submit" class="sort-submit">Lọc</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="container-p">
                <?php
                //initialise variable
                $sort = "";
                $sort_option = "";
                //check điều kiện để sort
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == "new") { //phân loại theo ngày thêm sp và thứ tự giảm dần
                        $sort = "c.CreateDate";
                        $sort_option = "DESC";
                    } elseif ($_GET['sort'] == "low") { //phân loại theo giá và thứ tự tăng dần
                        $sort = "Price";
                        $sort_option = "ASC";
                    } elseif ($_GET['sort'] == "high") { //phân loại theo giá và thứ tự giảm dần
                        $sort = "Price";
                        $sort_option = "DESC";
                    }
                } else {
                    $sort = "ProductQuantity";
                    $sort_option = "DESC";
                }
                //thực hiện query trong database
                $all_products = mysqli_query(
                    $con,
                    "SELECT c.CategoryID, ProductID, ProductName, ThumbnailImage, 
                    min(Price) AS `min`, max(Price) AS `max`, SUM(ProductQuantity) AS Quantity 
                    FROM `Categories` c INNER JOIN product p ON c.CategoryID = p.CategoryID                        
                    GROUP BY c.CategoryID ORDER BY $sort $sort_option"
                );
                $i = 1;
                //retreat data from the previous query
                while ($row = mysqli_fetch_array($all_products)) {
                    //check if the product is still available
                ?>
                    <div class="card-p">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="chef-item">

                                <!-- echo the category id -->
                                <a href="view_product.php?cid=<?php echo $row["CategoryID"] ?>&&id=<?php echo $_SESSION['id'] ?>">
                                    <div class="thumb">
                                        <div class="img">
                                            <?php
                                            //create img path
                                            $img =  "../assets/images/" . $row['ThumbnailImage'];
                                            ?>
                                            <!-- display img -->
                                            <img src="<?php echo $img ?>">
                                        </div>
                                    </div>
                                </a>
                                <div class="down-content">
                                    <div class="content">
                                        <a href="view_product.php?cid=<?php echo $row["CategoryID"] ?>&&id=<?php echo $_SESSION['id'] ?>">
                                            <div class="productName">
                                                <!-- display product name -->
                                                <h3><?php echo $row['ProductName']; ?></h3>
                                            </div>
                                        </a>
                                        <div class="price">
                                            <!-- if min = max then display only 1 price -->
                                            <?php if ($row['min'] == $row['max']) { ?>
                                                <h2><?php echo number_format($row['min']); ?>
                                                </h2>
                                                <h2>
                                                    <p class="discount">
                                                        <del>
                                                            <?php
                                                            $minValue = $row['min'];
                                                            $discountValue = $minValue * 100 / 80;
                                                            echo number_format(round($discountValue / 1000) * 1000);
                                                            ?>
                                                        </del>
                                                    </p>
                                                </h2>
                                                <!-- else display price range from min to max -->
                                            <?php } else { ?>
                                                <h2><?php echo number_format($row['min']); ?> - <?php echo number_format($row['max']); ?>
                                                </h2>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                    $i++;
                } ?>
            </div>
        </div>
    </section>

    <div>
        <?php include '../header_footer/footer.php'; ?>
    </div>

    <!-- jQuery -->
    <script src="/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="/assets/js/popper.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="/assets/js/owl-carousel.js"></script>
    <script src="/assets/js/accordions.js"></script>
    <script src="/assets/js/datepicker.js"></script>
    <script src="/assets/js/scrollreveal.min.js"></script>
    <script src="/assets/js/waypoints.min.js"></script>
    <script src="/assets/js/jquery.counterup.min.js"></script>
    <script src="/assets/js/imgfix.min.js"></script>
    <script src="/assets/js/slick.js"></script>
    <script src="/assets/js/lightbox.js"></script>
    <script src="/assets/js/isotope.js"></script>

    <!-- Global Init -->
    <script src="/assets/js/custom.js"></script>
    <script>
        $(function() {
            var selectedClass = "";
            $("p").click(function() {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function() {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });
        });
    </script>
</body>

</html>