<?php
session_start();
include('config.php');

$orderID = $_GET['id'];

$del = "UPDATE orders SET orderstatus = 3 where orderID = '$orderID'";
mysqli_query($db, $del);
header('Location:pending-orders.php');
?>