<?php
session_start();
if (isset($_SESSION['id'])) {
	include('../database/dbcon.php');
?>

	<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Trang Chủ </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
	</head>

	<body>
		<?php include '../header_footer/admin_header.php'; ?>
		<div class="main">
			<?php include '../header_footer/admin_toggle.php'; ?>
			<div class="cardHeader">
				<h2>Tổng quan</h2>
			</div>
			<div class="cardBox">
				<a href="../admin_manage_product/manage_category.php">
					<div class="card">
						<div>
							<div class="numbers">
								<?php
								$product = "SELECT ProductID FROM product";
								$product_run = mysqli_query($con, $product);
								$product_count = mysqli_num_rows($product_run);
								echo $product_count;
								?>
							</div>
							<div class="cardName">Sản phẩm</div>
						</div>
						<div class="iconBx">
							<i class="fa fa-shopping-basket" aria-hidden="true"></i>
						</div>
					</div>
				</a>
				<a href=../admin_manage_orders/manage_orders.php>
					<div class="card">
						<div>
							<div class="numbers">
								<?php
								$order = "SELECT OrderID FROM `order`";
								$order_run = mysqli_query($con, $order);
								$order_count = mysqli_num_rows($order_run);
								echo $order_count;
								?>
							</div>
							<div class="cardName">Đơn hàng</div>
						</div>
						<div class="iconBx">
							<i class="fa fa-archive" aria-hidden="true"></i>
						</div>
					</div>
				</a>
			</div>
		</div>
		</div>
		</div>
	</body>

	</html>
<?php
} else {
	header("Location: ../anon/homepage.php");
	exit();
}
?>