<?php
session_start();
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
if (count($_POST) > 0) {
    $category = $_POST['keyword'];
    $result = mysqli_query($con, "SELECT c.CategoryID AS CategoryID, ThumbnailImage, CategoryName, SUM(ProductQuantity) AS Quantity FROM `Categories` c 
    INNER JOIN product p ON c.CategoryID = p.CategoryID 
    WHERE c.CategoryID LIKE '%$category%' OR CategoryName LIKE '%$category%' LIKE '%$category%'                     
    GROUP BY p.CategoryID ORDER BY c.CategoryID;");
    $num = mysqli_num_rows($result);
    $page = $num / 7 + 1;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sản Phẩm </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="product_box">
            <div class="cardHeader">
                <h2>Sản Phẩm</h2>
            </div>
            <div class="border_bottom"></div>
            <form action="search_category.php" class="search-form" method="post">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box">
                <button type="submit" class="fa fa-search">
            </form>
        </div>
        <!-- delete and show product -->
        <?php if ($num > 0) { ?>
            <form action="" method="post" enctype="multipart/form-data">
                <button type="submit" class="button button3" name="delete_all" onclick='return checkdelete()'>
                    <i class="fa fa-trash-o"> Xóa Sản Phẩm</i>
                </button>
                <a href="storage.php">
                    <button type="button" class="button button2"><i class="fa fa-archive"> Xem Chi Tiết Kho</i></button>
                </a>
                <a href="add_basic.php">
                    <button type="button" class="button button1"><i class="fa fa-plus"> Thêm Sản Phẩm</i></button>
                </a>
                <table width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" value="" /></th>
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
                            <th>Tên sản phẩm</th>
                            <th>Số Lượng</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $i = 0;
                    ?>
                        <tbody>
                            <tr>
                                <th><input type="checkbox" name="choose_all[]" value="<?php echo $row['CategoryID']; ?>" /></th>
                                <th><?php echo $row['CategoryID']; ?></th>
                                <th>
                                    <?php
                                    //create img path
                                    $cp =  "../images/" . $row['ThumbnailImage'];;
                                    ?>
                                    <!-- display img -->
                                    <img src="<?php echo $cp ?>" width="100">
                                </th>
                                <th><?php echo $row['CategoryName']; ?></th>
                                <th><?php echo $row['Quantity']; ?></th>
                                <th>
                                    <a href=""><button type="button" class="fa fa-eye"></button></a>
                                    <a href=""><button type="button" class="fa fa-pencil-square-o"></button></a>
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
                    <?php for ($i = 1; $i <= $page; $i++) { ?>
                        <a> <?php echo $i ?></a>
                    <?php } ?>
                </div>
            </form>
        <?php } else { ?>
            <div class="message">Không Có Kết Quả Trùng Khớp</div>
        <?php } ?>



        <!-- confirm delete function -->
        <script>
            function checkdelete() {
                return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
            }
        </script>
        <?php
        // Delete Product
        if (isset($_GET['delete_product'])) {
            $delete_product = mysqli_query($con, "DELETE FROM categories WHERE CategoryID = '$_GET[delete_product]' ");
            if ($delete_product) {
                echo "<script> alert('Xóa Thành Công')</script>";
                echo "<script>window.open('manage_category.php?action=view_pro', '_self')</script>";
            }
        }

        // Delete selected items
        if (isset($_POST['choose_all'])) {
            $remove = $_POST['choose_all'];
            foreach ($remove as $key) {
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