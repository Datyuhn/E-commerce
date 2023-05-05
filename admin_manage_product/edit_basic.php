<?php
session_start();
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
?>

<!doctype html>
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

<?php
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $s = "SELECT * FROM `categories` WHERE CategoryID = '$cid'";
    $product = mysqli_query($con, $s);
    $pd = mysqli_fetch_array($product);
}
?>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="info-box">
            <h1> <u>Sửa sản phẩm</u></h1>
            <br>
            <br>
            <div class="content">
                <form action="" method="POST" role="form" enctype="multipart/form-data">
                    <h2>Thông tin cơ bản</h2>
                    <div class="panel-body">

                        <div class="form-group">
                            <span class="image"> Ảnh bìa</span>
                            <input type="file" name="image" id="image" value="<?php echo $pd['ThumbnailImage']; ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <span class=""> Tên sản phẩm</span>
                            <input type="text" name="nameC" id="" value="<?php echo $pd['CategoryName']; ?>" required>
                        </div>
                        <div class="form-group">
                            <span class="">Mã</span>
                            <input type="text" name="codeC" value="<?php echo $pd['CategoryID']; ?>" required>
                        </div>
                        <div id="error">
                            <?php
                            if (isset($_GET['error'])) { ?>
                                <p class="error"><?php echo $_GET['error']; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Tiếp" class="save">
                        </div>
                    </div>
                </form>
                <form action="manage_category.php">
                    <div class="form-group1">
                        <input type="submit" name="cancel" value="Hủy" class="cncl">
                    </div>
                </form>
                <?php

                if (isset($_POST['submit'])) {

                    $nameC = ucwords($_POST['nameC']);
                    $codeC = $_POST['codeC'];
                    $checkC = "SELECT * FROM categories WHERE CategoryID = '$codeC'";

                    $resultC = mysqli_query($con, $checkC);

                    $num = mysqli_num_rows($resultC);

                    if (isset($_FILES['image']['name'])) {
                        $image_name = $_FILES['image']['name'];

                        if ($image_name != "") {

                            $exp = explode('.', $image_name);

                            $ext = end($exp);
                            $strlow = strtolower($ext);

                            if ($strlow == 'jpg' || $strlow == 'png' || $strlow == 'jpeg') {
                                $image_name = "anh-" . rand(00000, 99999) . "." . $strlow;
                                $src = $_FILES['image']['tmp_name'];
                                $dst = "../assets/images/" . $image_name;
                                $upload = move_uploaded_file($src, $dst);
                                if ($upload == false) {
                                    echo "<script> window.location.href = 'add_basic.php?error=Upload Không Thành Công';</script>";
                                    exit();
                                }
                            } else {
                                echo "<script> window.location.href = 'add_basic.php?error=Ảnh Phải Có Đuôi .jpg, .png Hoặc .jpeg';</script>";
                                exit();
                            }
                        }
                    }

                    if (strlen($codeC) > 10) {
                        echo "<script> window.location.href = 'add_basic.php?error=Mã Không Được Vượt Quá 10 Ký Tự';</script>";
                        exit();
                    } elseif (strlen($nameC) > 200) {
                        echo "<script> window.location.href = 'add_basic.php?error=Tên Sản Phẩm Quá Dài';</script>";
                        exit();
                    } elseif ($num == 1) {
                        echo "<script> window.location.href = 'add_basic.php?error=Mã Đã Tồn Tại';</script>";
                        exit();
                    } elseif ($num == 1) {
                        echo "<script> window.location.href = 'add_basic.php?error=Mã Đã Tồn Tại';</script>";
                        exit();
                    } else {
                        $ex_cid = $pd['CategoryID'];
                        $sql1 = "INSERT INTO categories( CategoryID, CategoryName, ThumbnailImage)
                                        VALUES ('$codeC', '$nameC ', '$image_name')";
                        $query1 = mysqli_query($con, $sql1);
                        if ($query1) {
                            $sql2 = "SELECT * FROM categories WHERE CategoryID = '$codeC'";
                            $result = mysqli_query($con, $sql2);

                            $row = mysqli_fetch_assoc($result);

                            $_SESSION['cateID'] = $row["CategoryID"];
                            $_SESSION['ex_cid'] = $ex_cid;

                            echo "<script> window.location.href = 'edit_details.php';</script>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>