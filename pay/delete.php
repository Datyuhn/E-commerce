<?php  
session_start();
include('../database/dbcon.php');
if (isset($_SESSION['id'])) {
    $id = $_GET['id'];
    $cid = $_GET['cid'];
    $delete_product = mysqli_query($con, "DELETE FROM Cart WHERE ProductID = '$cid' && AccountID = '$id' ");
    if ($delete_product) {
        echo "<script> alert('Xóa Thành Công')</script>";
        echo "<script>window.open('../user_orders/Cart.php?action=view_pro', '_self')</script>";
    }
}else{
    header("Location: ../user_homepage/user_homepage.php");
    exit();
}
?>