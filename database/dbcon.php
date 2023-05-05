<?php

$dbhost = "localhost:3306";
$uname = "root";
$password = "";
$db_name = "BanHang";

$con = mysqli_connect($dbhost, $uname, $password, $db_name) or die("cannot connect");
