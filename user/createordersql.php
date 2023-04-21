<?php
session_start();
include('config.php');

$user = $_SESSION['login_user'];
$prodID = $_GET['id'];
$sql = "INSERT into orders (`userID`, `productID`) values ('$user', '$prodID')";
mysqli_query($db, $sql);
header('Location:thankyou.php')
?>