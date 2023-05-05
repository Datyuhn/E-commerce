<?php
session_start();
include '../header_footer/user_header.php';
if (isset($_SESSION['id'])) {
?>

    <!DOCTYPE html>
    <html lang="en">
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- <link rel="stylesheet" href="../assets/css/user_homepage.css"> -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

        <title>Klassy - PTIT Food</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    </head>

    <body>
        <!-- ***** Main Banner Area Start ***** -->
        <div id="top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="left-content">
                            <div class="inner-content">
                                <h4>Klassy</h4>
                                <h6>Ẩm thực Ao Sen</h6>
                                <div class="main-white-button scroll-to-section">
                                    <a href="#menu">Đặt ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="main-banner header-text">
                            <div class="Modern-Slider">
                                <!-- Item -->
                                <div class="item">
                                    <div class="img-fill">
                                        <img src="/assets/images/slide-01.jpg" alt="">
                                    </div>
                                </div>
                                <!-- // Item -->
                                <!-- Item -->
                                <div class="item">
                                    <div class="img-fill">
                                        <img src="/assets/images/slide-02.jpg" alt="">
                                    </div>
                                </div>
                                <!-- // Item -->
                                <!-- Item -->
                                <div class="item">
                                    <div class="img-fill">
                                        <img src="/assets/images/slide-03.jpg" alt="">
                                    </div>
                                </div>
                                <!-- // Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Main Banner Area End ***** -->

        <!-- ***** About Area Starts ***** -->
        <section class="section" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="left-text-content">
                            <div class="section-heading">
                                <h6>Giới thiệu</h6>
                                <h2>Lạc trôi vào "thiên đường ẩm thực" Ao Sen</h2>
                            </div>
                            <p>
                                Ao Sen (Phú Lãm, Hà Đông) là con ngõ quen thuộc và là nơi gửi gắm niềm đam mê ăn uống bất tận của các thần dân Đại học Kiến Trúc, hay Học viện Bưu chính Viễn thông… Ngõ không lớn, nhưng lại sở hữu vô vàn món ăn từ bình dân đến sang chảnh, đa dạng phong cách và hợp túi tiền sinh viên. Bằng cách đặt hàng quan web bạn có thể trải nghiệm thiên đường ẩm thực này.
                            </p>
                            <div class="row">
                                <div class="col-4">
                                    <img src="/assets/images/about-thumb-01.jpg" alt="">
                                </div>
                                <div class="col-4">
                                    <img src="/assets/images/about-thumb-02.jpg" alt="">
                                </div>
                                <div class="col-4">
                                    <img src="/assets/images/about-thumb-03.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="right-content">
                            <div class="thumb">
                                <a rel="nofollow" target="_blank" href="https://www.youtube.com/results?search_query=%C4%83n+v%C4%83%CC%A3t+ao+sen"><i class="fa fa-play"></i></a>
                                <img src="/assets/images/about-video-bg.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** About Area Ends ***** -->

        <!-- ***** Menu Area Starts ***** -->
        <section class="section" id="menu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section-heading">
                            <h6>Menu nổi bật</h6>
                            <h2>Nổi bật tại Ao Sen</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-item-carousel">
                <div class="col-lg-12">
                    <div class="owl-menu-item owl-carousel">
                        <div class="item">
                            <div class="card" style="background-image: url(../assets/images/Cơm\ rang\ dưa\ bò.jpg)">
                                <div class="price">
                                    <h6>-20%</h6>
                                </div>
                                <div class='info'>
                                    <h1 class='title'>Cơm rang dưa bò</h1>
                                    <!-- <p class='description'>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                    sedii do eiusmod teme.</p> -->
                                    <div class="main-text-button">
                                        <div class="scroll-to-section"><a href="../user_products/view_product.php?cid=Com4&&id=1">Đặt ngay<i class="fa fa-angle-down"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card" style="background-image: url(../assets/images/Cơm\ chiên\ hải\ sản.jpg)">
                                <div class="price">
                                    <h6>-20%</h6>
                                </div>
                                <div class='info'>
                                    <h1 class='title'>Cơm chiên hải sản</h1>
                                    <div class="main-text-button">
                                        <div class="scroll-to-section"><a href="../user_products/view_product.php?cid=Com1&&id=1">Đặt ngay <i class="fa fa-angle-down"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card" style="background-image: url(../assets/images/Cơm\ chiên\ xúc\ xích.jpg)">
                                <div class="price">
                                    <h6>-20%</h6>
                                </div>
                                <div class='info'>
                                    <h1 class='title'>Cơm chiên xúc xích</h1>
                                    <div class="main-text-button">
                                        <div class="scroll-to-section"><a href="../user_products/view_product.php?cid=Com2&&id=1">Đặt ngay<i class="fa fa-angle-down"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card" style="background-image: url(../assets/images/Cơm\ gà\ xối\ mỡ.jpg)">
                                <div class="price">
                                    <h6>-20%</h6>
                                </div>
                                <div class='info'>
                                    <h1 class='title'>Cơm gà xối mỡ</h1>
                                    <div class="main-text-button">
                                        <div class="scroll-to-section"><a href="../user_products/view_product.php?cid=Com3&&id=1">Đặt ngay<i class="fa fa-angle-down"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card" style="background-image: url(../assets/images/Cơm\ tấm\ thịt\ nướng.jpg)">
                                <div class="price">
                                    <h6>-20%</h6>
                                </div>
                                <div class='info'>
                                    <h1 class='title'>Cơm tấm thịt nướng</h1>
                                    <div class="main-text-button">
                                        <div class="scroll-to-section"><a href="../user_products/view_product.php?cid=Com7&&id=1">Đặt ngay<i class="fa fa-angle-down"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card" style="background-image: url(../assets/images/Cơm\ thịt\ kho\ trứng.jpg)">
                                <div class="price">
                                    <h6>-20%</h6>
                                </div>
                                <div class='info'>
                                    <h1 class='title'>Cơm thịt kho trứng</h1>
                                    <div class="main-text-button">
                                        <div class="scroll-to-section"><a href="">Đặt ngay<i class="fa fa-angle-down"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card" style="background-image: url(../assets/images/Cơm\ rang\ Dương\ Châu.jpg)">
                                <div class="price">
                                    <h6>-20%</h6>
                                </div>
                                <div class='info'>
                                    <h1 class='title'>Cơm rang Dương Châu</h1>
                                    <div class="main-text-button">
                                        <div class="scroll-to-section"><a href="../user_products/view_product.php?cid=Com5&&id=1">Đặt ngay<i class="fa fa-angle-down"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Menu Area Ends ***** -->

        <div><?php include '../header_footer/footer.php'; ?></div>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
    exit();
}
?>