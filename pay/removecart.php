<?php  
session_start();
include('../database/dbcon.php');
if (isset($_SESSION['id'])) {
     $id = $_GET['id'];
     $cid = $_GET['cid'];
     $val = $_GET['value'];
     $s = "SELECT * FROM `Cart` where AccountID = '$id' && ProductID = '$cid'";
     $get_products = mysqli_query($con,$s);
     $product = mysqli_fetch_array($get_products);
     if ($product['ProductQuantity']==NULL){
        echo "<script> alert('Không thể xóa')</script>";
     }else{
         $ProductQuantity1 = $product['ProductQuantity'];
         $ProductQuantity = $ProductQuantity1 - 1;
         if($ProductQuantity != 0){
            $remove_product = mysqli_query($con, "UPDATE `Cart` SET `ProductQuantity`='$ProductQuantity' WHERE AccountID = '$id' && ProductID = '$cid'");
         }
         else{
            $remove_product = mysqli_query($con, "DELETE FROM `Cart` WHERE AccountID = '$id' && ProductID = '$cid'");
         }
     }
     if ($remove_product) {
         echo "<script> alert('Xóa Thành Công')</script>";
         echo "<script>window.open('../user_orders/Cart.php?cid=$cid&&id=$id', '_self')</script>";
     }else{
        echo "<script> alert('Không thể xóa')</script>";
    }

}else{
    header("Location: ../user_homepage/user_homepage.php");
    exit();
}
?>