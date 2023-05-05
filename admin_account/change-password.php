<?php
session_start();
if (isset($_SESSION['id'])) {
?>
  <!DOCTYPE html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">
  </head>

  <body>
    <section>
      <div class="img">
        <img src="../assets/images/background3.jpg">
      </div>
      <div class="content">
        <div class="form">
          <h2>Đổi mật khẩu</h2>
          <form action="pass-check.php" method="post">
            <div class="input">
              <span>Nhập mật khẩu cũ</span>
              <input type="password" id="old_pass" name="old_pass" placeholder="Nhập mật khẩu cũ" class="form-control" required>

            </div>
            <div class="input">
              <span>Nhập mật khẩu mới</span>
              <input type="password" id="new_pass" name="new_pass" placeholder="Nhập mật khẩu mới" class="form-control" required>

            </div>
            <div class="input">
              <span>Xác nhận mật khẩu mới</span>
              <input type="password" id="new_pass1" name="new_pass1" placeholder="Xác nhận mật khẩu mới" class="form-control" required>

            </div>
            <!--show password -->
            <input type="checkbox" onclick="myFunction()">Hiện Mật Khẩu
            <script>
              function myFunction() {
                var x = document.getElementById("old_pass");
                var y = document.getElementById("new_pass");
                var z = document.getElementById("new_pass1");
                if (x.type === "password" && y.type === "password" && z.type === "password") {
                  x.type = "text";
                  y.type = "text";
                  z.type = "text";
                } else {
                  x.type = "password";
                  y.type = "password";
                  z.type = "password";
                }
              }
            </script>
            <!-- get error -->
            <?php if (isset($_GET['error'])) { ?>
              <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <div class="input">
              <input type="submit" value="Đổi mật khẩu">
            </div>
          </form>

        </div>
      </div>
    </section>
  </body>

  </html>
<?php
} else {
  header("Location: ../anon/homepage.php");
  exit();
}
?>