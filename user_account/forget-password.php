<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quên mật khẩu</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/css/templatemo-klassy-cafe.css">
  <link rel="stylesheet" href="../assets/css/owl-carousel.css">
  <link rel="stylesheet" href="../assets/css/lightbox.css">
  <style>
    .section {
      height: 100vh;
    }

    #contact {
      background-color: #ddd;
    }
  </style>
</head>

<body>
  <section class="section" id="reservation">
    <div class="container row">
      <div class="col-lg-6"></div>
      <div class="col-lg-6">
        <div class="contact-form">
          <form action="send-new.php" id="contact" method="post">
            <div class="col-lg-12">
              <h4>Quên mật khẩu</h4>
            </div>
            <div class="input">
              <span>Email</span>
              <input type="text" name="eot" placeholder="Nhập Email" class="form-control" required>
            </div>
            <div class="input">
              <span>Nhập Số Điện Thoại</span>
              <input type="tel" name="telephone" placeholder="Nhập Số Điện Thoại" class="form-control" required>
            </div>

            <?php if (isset($_GET['error'])) { ?>
              <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
              <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <br>
            <div class="col-lg-12">
              <fieldset>
                <button type="submit" id="form-submit" class="main-button-icon">Lấy lại mật khẩu</button>
              </fieldset>
            </div>
            <br>
            <div class="col-lg-6 col-sm-12">
              <fieldset>
                <a href="login.php">Đăng nhập</a>
              </fieldset>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- jQuery -->
  <script src="../assets/js/jquery-2.1.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="../assets/js/popper.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>

  <!-- Plugins -->
  <script src="../assets/js/owl-carousel.js"></script>
  <script src="../assets/js/accordions.js"></script>
  <script src="../assets/js/datepicker.js"></script>
  <script src="../assets/js/scrollreveal.min.js"></script>
  <script src="../assets/js/waypoints.min.js"></script>
  <script src="../assets/js/jquery.counterup.min.js"></script>
  <script src="../assets/js/imgfix.min.js"></script>
  <script src="../assets/js/slick.js"></script>
  <script src="../assets/js/lightbox.js"></script>
  <script src="../assets/js/isotope.js"></script>

  <!-- Global Init -->
  <script src="../assets/js/custom.js"></script>
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