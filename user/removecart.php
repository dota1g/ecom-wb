<?php
session_start();
include('config.php');

$user = $_SESSION['login_user'];
$cartID = $_GET['id'];
$usersql = "SELECT * from users where username = '$user' or email = '$user'";
$result = mysqli_query($db, $usersql);
$userRow = mysqli_fetch_assoc($result);
$userID = $userRow['userID'];

$cartsql = "DELETE FROM cart where cartID = '$cartID'";
mysqli_query($db, $cartsql);
header('Location:cart.php');