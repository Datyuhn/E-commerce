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
        <!-- <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>"> -->
        <script src="https://kit.fontawesome.com/ccd3f2c1ca.js" crossorigin="anonymous"></script>
        <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </head>

    <body>

        <?php
        //create img path
        $img =  "../assets/images/" . $row['ThumbnailImage'];

        ?>
        <section class="section" id="offers">
            <div class="card-wrapper">
                <div class="card">
                    <div class="product-imgs">
                        <!-- image box -->
                        <div class="img-display">
                            <div class="img-showcase">
                                <img src="<?php echo $img ?>" alt="<?php echo $row["ProductName"] ?>">
                            </div>
                        </div>
                        <!-- click on image to see -->
                    </div>
                    <div class="product-content">
                        <!-- product name -->
                        <h2 class="product-title">
                            <?php echo $row["ProductName"]; ?>
                        </h2>
                        <!-- product price -->
                        <div class="product-price">
                            <p id="price">
                                <?php
                                echo number_format($row["Price"]);
                                ?>
                            </p>
                        </div>

                        <div class="btn__buy">
                            <a href="../pay/addcart.php?id=<?php echo $id ?>&cid=<?php echo $cid; ?>&value=<?php echo 1 ?>" style="text-decoration: none;">
                                <button class="btn__buy-lable--btn btn__buy-primar">ĐẶT HÀNG NGAY</button>
                            </a>
                            <a href="../pay/addcart.php?id=<?php echo $id ?>&cid=<?php echo $cid; ?>&value=<?php echo 0 ?>" style="text-decoration: none;">
                                <button class="btn__buy-lable--btn">THÊM VÀO GIỎ HÀNG</button>
                            </a>
                        </div>
                    </div>
                    <a href="../user_products/product_page.php" style="text-decoration: none;">
                        <button class="btn__buy-lable--btn">QUAY LẠI</button>
                    </a>
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