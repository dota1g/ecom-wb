<?php
session_start();
include('config.php');

$orderID = $_GET['id'];

$del = "UPDATE orders SET orderstatus = 2 where orderID = '$orderID'";
mysqli_query($db, $del);
header('Location:pending-orders.php');