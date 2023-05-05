<?php
session_start();
include('../database/dbcon.php');
include('../header_footer/user_header.php');
if (isset($_GET['sp'])) {
    $id = $_SESSION['id'];
    $sumSP = $_GET['sp'];
    $sumTien = $_GET['tien'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thanh toán</title>
        <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

        <style>
            .col-lg-6 {
                max-width: 100%;
            }
        </style>
    </head>

    <body>
        <section class="section" id="reservation">
            <div class="container">
                <div class="col-lg-6">
                    <div class="contact-form">
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                        <form id="contact" action="../pay/addorder.php?id=<?php echo $id ?>&&sp=<?php echo $sumSP ?>&&tien=<?php echo $sumTien ?>" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Hóa đơn</h4>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" id="name" placeholder="Họ và tên*" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Địa chỉ Email" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="phone" type="text" id="phone" placeholder="Số điện thoại*" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <input name="address" type="text" id="address" placeholder="Địa chỉ*" required="">
                                    </fieldset>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <div>Tổng sản phẩm: <?php echo $sumSP; ?></div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <div>Tổng tiền thanh toán: <?php echo $sumTien; ?></div>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" id="message" placeholder="Lời nhắn"></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="main-button-icon" onclick="checkValid()">Thanh toán</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <script>
            function checkdelete() {
                return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../user_account/login.php");
    exit();
}
?>