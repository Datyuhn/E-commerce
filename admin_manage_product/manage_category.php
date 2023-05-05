<?php
include('../database/dbcon.php');
include '../header_footer/admin_header.php';

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Menu </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="product_box">
            <div class="cardHeader">
                <h2>DANH SÁCH SẢN PHẨM</h2>
            </div>
            <div class="border_bottom"></div>
            <form action="search_category.php" class="search-form" method="post">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box" required>
                <button type="submit" class="fa fa-search">
            </form>
            <!-- delete and show product -->
            <form action="" method="post" enctype="multipart/form-data">
                <button type="submit" class="button button3" name="delete_all" onclick='return checkdelete()'><i class="fa fa-trash-o"> Xóa</i>
                </button>
                <a href="storage.php">
                    <button type="button" class="button button2"><i class="fa fa-archive"> Xem Chi Tiết Kho</i></button>
                </a>
                <a href="add_basic.php">
                    <button type="button" class="button button1"><i class="fa fa-plus"> Thêm Mới</i></button>
                </a>
                <table width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" value="" /></th>
                            <!-- check all the checkbox -->
                            <script>
                                $('#checkAll').click(function(event) {
                                    if (this.checked) {
                                        // Iterate each checkbox
                                        $(':checkbox').each(function() {
                                            this.checked = true;
                                        });
                                    } else {
                                        $(':checkbox').each(function() {
                                            this.checked = false;
                                        });
                                    }
                                });
                            </script>
                            <th>Mã</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <?php

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
                    define("PER_PAGE", "5"); // ENTRIES PER PAGE
                    $stmt = $pdo->prepare("SELECT CEILING(COUNT(*) / " . PER_PAGE . ") `pages` FROM `categories`");
                    $stmt->execute();
                    $pageTotal = $stmt->fetchColumn();

                    // (C) GET ENTRIES FOR CURRENT PAGE
                    // (C1) LIMIT (X, Y) FOR SQL QUERY
                    $pageNow = isset($_GET["page"]) ? $_GET["page"] : 1;
                    $limX = ($pageNow - 1) * PER_PAGE;
                    $limY = PER_PAGE;
                    $all_products = mysqli_query(
                        $con,
                        "SELECT c.CategoryID AS CategoryID, ThumbnailImage, CategoryName, SUM(ProductQuantity) AS Quantity FROM `Categories` c 
                        INNER JOIN product p ON c.CategoryID = p.CategoryID                        
                        GROUP BY p.CategoryID ORDER BY c.CreateDate DESC
                        LIMIT $limX, $limY"
                    );
                    $i = 1;
                    while ($row = mysqli_fetch_array($all_products)) {

                    ?>
                        <tbody>
                            <tr>
                                <th><input type="checkbox" name="choose_all[]" value="<?php echo $row['CategoryID']; ?>" /></th>
                                <th><?php echo $row['CategoryID']; ?></th>
                                <th>
                                    <?php
                                    //create img path
                                    $thumbnail =  "../assets/images/" . $row['ThumbnailImage'];;
                                    ?>
                                    <!-- display img -->
                                    <img src="<?php echo $thumbnail ?>" width="100">
                                </th>
                                <th><?php echo $row['CategoryName']; ?></th>

                                <th>
                                    <a href=""><button type="button" class="fa fa-eye"></button></a>
                                    <a href="edit_basic.php?cid=<?php echo $row['CategoryID']; ?>"><button type="button" class="fa fa-pencil-square-o"></button></a>
                                    <a href="manage_category.php?action=view_pro&delete_product=<?php echo $row['CategoryID']; ?>">
                                        <button type="button" id="delete" class="fa fa-trash-o" onclick='return checkdelete()'></button>
                                        <!-- CALL CHECKDELETE FUNCTION -->
                                    </a>
                                </th>
                            </tr>
                        </tbody>
                    <?php $i++;
                    } ?>
                </table>
                <div class="pagination" id="pagination">
                    <?php

                    for ($i = 1; $i <= $pageTotal; $i++) {
                        printf(
                            "<a %shref='manage_category.php?page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }

                    ?>
                </div>
            </form>
        </div>
        <!-- confirm delete function -->
        <script>
            function checkdelete() {
                return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
            }
        </script>
        <?php
        // Delete Product by icon
        if (isset($_GET['delete_product'])) {
            //delete img from folder first
            $find_img = mysqli_query($con, "SELECT * FROM categories WHERE CategoryID = '$_GET[delete_product]'");
            $row1 = mysqli_fetch_assoc($find_img);
            $img = $row1['ThumbnailImage'];
            //create delete path
            $crd = "../images/" . $img;
            //delete img
            unlink($crd);

            $delete_product = mysqli_query($con, "DELETE FROM categories WHERE CategoryID = '$_GET[delete_product]' ");
            if ($delete_product) {
                echo "<script> alert('Xóa Thành Công')</script>";
                echo "<script>window.open('manage_category.php?action=view_pro', '_self')</script>";
            }
        }

        // Delete selected items
        //if check bock is checked
        if (isset($_POST['choose_all'])) {
            //initialise variable
            $remove = $_POST['choose_all'];

            //run loop to take the id of product that is checked
            foreach ($remove as $key) {

                //delete img from folder first
                $find_img = mysqli_query($con, "SELECT * FROM categories WHERE CategoryID = '$key'");
                $row1 = mysqli_fetch_assoc($find_img);
                $img = $row1['ThumbnailImage'];
                //create delete path
                $crd = "../assets/images/" . $img;
                //delete img
                unlink($crd);

                $run_remove = mysqli_query($con, "DELETE FROM categories WHERE CategoryID = '$key' ");

                if ($run_remove) {
                    echo "<script> alert('Xóa Thành Công')</script>";
                    echo "<script>window.open('manage_category.php?action=view_pro', '_self')</script>";
                } else {
                    echo "<script>alert('Lỗi: mysqli_error($con)!')</script>";
                }
            }
        }
        ?>
    </div>
</body>

</html>