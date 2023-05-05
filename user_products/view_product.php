<?php
session_start();
include('../database/dbcon.php');
include('../header_footer/user_header.php');
if (isset($_SESSION['id'])) {
    $id = $_GET['id'];
    $cid  = $_GET['cid'];
    $product = "SELECT * FROM `categories` WHERE `CategoryID` = '$cid'";
    $pro_details = "SELECT c.*, ProductID, ProductName, Price, ProductQuantity
FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
WHERE c.CategoryID = '$cid'";
    $sql = mysqli_query($con, $pro_details);
    $row = mysqli_fetch_array($sql);
    $img =  "../assets/images/" . $row['ThumbnailImage'];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title><?php echo $row["ProductName"] ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="../css/product.css?v=<?php echo time(); ?>"> -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/ccd3f2c1ca.js" crossorigin="anonymous"></script>
        <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <style>
            .single-product {
                margin-top: 80px;
            }

            .single-product .col-3 {
                padding: 20px;
            }

            .single-product .col-3 img {
                padding: 10px;
            }

            .single-product h4 {
                margin: 20px 0;
                font-size: 22px;
                font-weight: bold;
            }

            .single-product input {
                width: 50px;
                height: 40px;
                padding-left: 10px;
                font-size: 20px;
                margin-right: 10px;
                margin-bottom: 10px;
                border: 1px solid #fb5849;
            }

            button {
                border: none;
                color: white;
                padding: 10px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                background-color: #fb5849;
            }

            input:focus {
                outline: none;
            }
        </style>
    </head>

    <body>
        <?php
        //create img path
        $img =  "../assets/images/" . $row['ThumbnailImage'];

        ?>
        <section class="section" id="offers">
            <div class="small-container single-product">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <img src="<?php echo $img ?>" alt="" width="100%">
                    </div>
                    <div class="col-3">
                        <p>
                            <a href="/user_homepage/user_homepage.php" style="color:#ff5849">Trang chủ</a>
                        </p>
                        <h1><?php echo $row["ProductName"] ?></h1>
                        <h4><?php echo number_format($row["Price"]); ?></h4>
                        <input type="number" value="1">
                        <br>
                        <a class="tc" href="../pay/addcart.php?id=
                        <?php echo $id ?>&cid=<?php echo $cid; ?>&value=<?php echo 0 ?>">
                            <button class="">Thêm vào giỏ hàng</button>
                        </a>
                        <a href="../user_products/product_page.php">
                            <button class="">Quay lại</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                $('.minus').click(function() {
                    var $input = $(this).parent().find('input');
                    var count = parseInt($input.val()) - 1;
                    count = count < 1 ? 1 : count;
                    $input.val(count);
                    $input.change();
                    return false;
                });
                $('.plus').click(function() {
                    var $input = $(this).parent().find('input');
                    $input.val(parseInt($input.val()) + 1);
                    $input.change();
                    return false;
                });
            });


            const imgs = document.querySelectorAll('.img-select a');
            const imgBtns = [...imgs];
            let imgId = 1;

            imgBtns.forEach((imgItem) => {
                imgItem.addEventListener('click', (event) => {
                    event.preventDefault();
                    imgId = imgItem.dataset.id;
                    slideImage();
                });
            });

            function slideImage() {
                const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

                document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
            }

            window.addEventListener('resize', slideImage);
        </script>
    <?php
} else {
    header("Location: ../user_account/login.php");
    exit();
}
    ?>
    <footer><?php include '../header_footer/footer.php'; ?></footer>
    </body>

    </html>