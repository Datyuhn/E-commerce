<?php
session_start ();
include('../database/dbcon.php');
include '../header_footer/user_header.php';
include '../header_footer/user_bar.php';
if (isset($_SESSION['id'])) { 
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đồ ăn</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
    </head>

    <body id = "pro-page">
        <div class ="main">
        <div class="bar">
        <form action ="" method = "get">
                <div class = "row">
                    <div class = "col1">
                        <div class = "sort-box">
                            <select name = "sort" id="sort" class = "form-control">
                                <!-- select sorting option and remember the option when the page is reload -->
                                <option value="new" <?php if(isset($_GET['sort']) && $_GET['sort'] == "new"){echo "selected";}?>>Mới Nhất</option>
                                <option value="low" <?php if(isset($_GET['sort']) && $_GET['sort'] == "low"){echo "selected";}?>>Giá: Thấp đến Cao</option>
                                <option value="high" <?php if(isset($_GET['sort']) && $_GET['sort'] == "high"){echo "selected";}?>>Giá: Cao đến Thấp</option>
                            </select>
                            <button type = "submit" class = "sort-submit">Lọc</button>
                        </div>
                    </div>
                </div>
            </form>
        <div class="container-p" id = 1>
                <?php
                //initialise variable
                $sort = "";  
                $sort_option = "";
                //check điều kiện để sort
                if(isset($_GET['sort'])){
                    if($_GET['sort'] == "new"){ //phân loại theo ngày thêm sp và thứ tự giảm dần
                        $sort = "c.CreateDate";
                        $sort_option = "DESC";
                    } elseif($_GET['sort'] == "low"){ //phân loại theo giá và thứ tự tăng dần
                        $sort = "Price";
                        $sort_option = "ASC";
                    }elseif($_GET['sort'] == "high"){ //phân loại theo giá và thứ tự giảm dần
                        $sort = "Price";
                        $sort_option = "DESC";
                    }
                } else {
                    $sort = "ProductQuantity";  
                    $sort_option = "DESC";
                }  
                $all_products = mysqli_query(
                    $con,
                    "SELECT c.CategoryID, ProductID, ProductName, ThumbnailImage, min(Price) AS `min`, max(Price) AS `max`, SUM(ProductQuantity) AS Quantity 
                    FROM `Categories` c INNER JOIN product p ON c.CategoryID = p.CategoryID  
                    WHERE ProductName NOT LIKE 'Cơm%' AND ProductName NOT LIKE 'Nước%' GROUP BY c.CategoryID                        
                    ORDER BY $sort $sort_option"
                );
                $i = 1;
                //retreat data from the previous query
                while ($row = mysqli_fetch_array($all_products)) {
                    //check if the product is still available
                ?>  
                        <div class="card-p">
                            <form action="" method="post" enctype="multipart/form-data">
                                <!-- echo the category id -->
                                <a href = "view_product.php?cid=<?php echo $row["CategoryID"]?>&&id=<?php echo $_SESSION['id']?>">
                                    <div class="img">
                                        <?php 
                                        //create img path
                                        $img =  "../images/".$row['ThumbnailImage'];
                                        ?>
                                        <!-- display img -->
                                        <img src="<?php echo $img ?>">
                                    </div>
                                </a>
                                <div class="content">
                                    <a href = "view_product.php?cid=<?php echo $row["CategoryID"]?>&&id=<?php echo $_SESSION['id']?>">
                                        <div class="productName">
                                            <!-- display product name -->
                                            <h3><?php echo $row['ProductName'];?></h3>
                                        </div>
                                    </a>
                                    <div class="price">
                                        <!-- if min = max then display only 1 price -->
                                        <?php if($row['min'] == $row['max']){?>
                                            <h2><?php echo number_format($row['min']);?>
                                            </h2>
                                        <!-- else display price range from min to max -->
                                        <?php } else {?>    
                                            <h2><?php echo number_format($row['min']);?> - <?php echo number_format($row['max']);?>
                                            </h2>
                                        <?php } ?>  
                                    </div>
                                </div>
                            </form>
                        </div>
                <?php 
                $i++;
                } ?>
        </div>
        </div>
        <footer><?php include '../header_footer/user_footer.php'; ?></footer> 
    </body>
</html>
<?php 
}else{
     header("Location: ../user_account/login.php");
     exit();
}
 ?>
            