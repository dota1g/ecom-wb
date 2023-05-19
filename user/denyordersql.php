<?php
session_start();
include('config.php');

$orderID = $_GET['id'];

$del = "UPDATE orders SET orderstatus = 4 where orderID = '$orderID'";
mysqli_query($db, $del);
header('Location:cart.php');
?>