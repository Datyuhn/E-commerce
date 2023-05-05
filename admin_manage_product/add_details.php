<?php
session_start();
include('../database/dbcon.php');
include '../header_footer/admin_header.php';

//get the session variable value
$cID = $_SESSION['cateID'];
//find the info of the category that has been previously saved
$cate = "SELECT * FROM categories WHERE CategoryID = '$cID'";
//Perform query against the database
$result = mysqli_query($con, $cate);
//count number of row that appear from the previous query
$num = mysqli_num_rows($result);
//take the result
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sản Phẩm</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="main"><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="info-box">
            <div class="content">
                <!-- allow to upload file -->
                <form action="" method="post" enctype="multipart/form-data">
                    <h2>Thông Tin Chi Tiết</h2>
                    <div class="panel-body">
                        <?php //display error message
                        if (isset($_GET['error'])) { ?>
                            <p class="error"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                        <div class="form-group">
                            <span class=""> Mã Sản Phẩm</span>
                            <input type="text" name="codeP" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <span class=""> Số lượng</span>
                            <input type="number" name="quantity" placeholder=""></input>
                        </div>
                        <div class="form-group">
                            <span class=""> Giá</span>
                            <input type="number" name="price" placeholder=""></input>
                        </div>
                        <!-- save -->
                        <div class="form-group">
                            <input type="submit" name="submit" value="Lưu" class="btn-secondary">
                        </div>
                    </div>
                </form>
                <form action="" method="post">
                    <div class="form-group1">
                        <input type="submit" name="cancel" value="Hủy" class="cncl">
                    </div>
                </form>
                <?php
                //if the "Lưu" button is pressed
                if (isset($_POST['submit'])) {

                    //initialise the variable       
                    $codeP = $_POST['codeP'];
                    $quantity = $_POST['quantity'];
                    $price = $_POST['price'];

                    //find the info of the category that has been previously saved
                    $pro = "SELECT * FROM product WHERE ProductID = '$codeP'";
                    //Perform query against the database
                    $result1 = mysqli_query($con, $pro);
                    //count number of row that appear from the previous query
                    $num1 = mysqli_num_rows($result1);

                    //set the variable's value to the value in the database      
                    $nameC = $row["CategoryName"];
                    $codeC = $row["CategoryID"];
                    //check product info
                    //check category id length
                    if (strlen($codeP) > 10) {
                        echo "<script> window.location.href = 'add_details.php?error=Mã Sản Phẩm Không Được Vượt Quá 10 Ký Tự';</script>";
                        exit();
                    } //check if the categoryID is duplicate or not
                    elseif ($num1 == 1) {
                        echo "<script> window.location.href = 'add_details.php?error=Mã Sản Phẩm Đã Tồn Tại';</script>";
                        exit();
                    } elseif (!preg_match('/^[0-9]+$/', $price)) {
                        echo "<script> window.location.href = 'add_details.php?error=Số Lượng: Nội Dung Không Hợp Lệ';</script>";
                        exit();
                    } //insert into database
                    else {
                        $sql2 = "INSERT INTO product (CategoryID, ProductID, ProductName, ProductQuantity, Price)
                            VALUES ('$codeC', '$codeP','$nameC', $quantity, '$price')";
                        $query2 = mysqli_query($con, $sql2);
                        echo "<script> alert('Sản Phẩm Đã Được Thêm');
                            window.location.href = 'manage_category.php';</script>";
                    }
                } elseif (isset($_POST['cancel'])) {

                    //delete image from folder
                    $img = $row['ThumbnailImage'];
                    //create delete path
                    $crd = "../assets/images/" . $img;
                    //delete img
                    unlink($crd);
                    unlink($crd4);
                    $dlt = "DELETE FROM categories WHERE CategoryID = '$cID'";
                    $dlt_cate = mysqli_query($con, $dlt);
                    echo "<script> window.location.href = 'manage_category.php';</script>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>