<?php
session_start();
include('config.php');

$user = $_SESSION['login_user'];
$prodID = $_GET['id'];
$usersql = "SELECT * from users where username = '$user' or email = '$user'";
$result = mysqli_query($db, $usersql);
$userRow = mysqli_fetch_assoc($result);
$userID = $userRow['userID'];

$cartsql = "INSERT into orders (`userID`, `productID`) values ('$userID', '$prodID')";
mysqli_query($db, $cartsql);
header('Location:thankyou.php')
?>