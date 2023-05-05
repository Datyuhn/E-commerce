<?php  
session_start();
include('../database/dbcon.php');
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
if (isset($_SESSION['id'])) {
    $random_id_length = 6;
    $order_id = generateRandomString( $random_id_length );
    $address = $_POST['address'];
    $name = $_POST['name'];
    $tel = $_POST['phone'];
    $id = $_GET['id'];
    $cost = $_GET['tien'];
    $sum_product = $_GET['sp'];
    if($name==NULL || $tel==NULL ||$address==NULL){
        header("Location: ../user_page/thanhToan.php?id=$id&&sp=$sum_product&&tien=$cost&&error=Không được để trống");
        exit();
    }else{
        $s = "SELECT * FROM `Cart` 
            where AccountID = '$id'";
        $sl = mysqli_query($con,$s);
        $insert_list = mysqli_query($con, "INSERT INTO `Order`(`OrderID`,`Cost`, `Total`) VALUES ('$order_id','$cost','$sum_product')");
        while ($row = mysqli_fetch_array($sl)) {
            $cid = $row['ProductID'];
            $product_row = $row['ProductQuantity'];
            $search_product = mysqli_query($con,"SELECT * FROM `Product` 
            where ProductID = '$cid'");
            $search_product1 =  mysqli_fetch_assoc($search_product);
            $price_row = $search_product1['Price'];
            $insert_product = mysqli_query($con, "INSERT INTO `Order_Details`(`AccountID`, `ProductID`, `amount`, `Cost`, `CustomerName`, `CustomerPhoneNo`, `CustomerAddress`, `OrderID`) VALUES ('$id','$cid','$product_row','$price_row','$name','$tel','$address','$order_id')");
            $update_warehouse = mysqli_query($con,"UPDATE Product SET ProductQuantity = ProductQuantity - $product_row WHERE ProductID = '$cid'");
        }
        $delete_product = mysqli_query($con,"DELETE FROM Cart WHERE AccountID = '$id'");
        if($delete_product){
            echo "<script> alert('Thanh toán thành công')</script>";
            echo "<script>window.open('../user_homepage/user_homepage.php?action=view_pro', '_self')</script>";
        }
    }
}else{
    header("Location: ../user_page/homepage.php");
    exit();
}
?>