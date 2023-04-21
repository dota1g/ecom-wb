<?php 
session_start();
include('config.php');

$user = $_SESSION['login_user'];
$emailID = $_GET['id'];
$usersql = "SELECT * from users where username = '$user' or email = '$user'";
$result = mysqli_query($db, $usersql);
$userRow = mysqli_fetch_assoc($result);
$userID = $userRow['userID'];

$sql = "UPDATE email set didUserReadMsg = 1 where userID ='$userID' and emailID = '$emailID'";
mysqli_query($db, $sql);
header("Location:readmail.php?id=".$emailID."")

?>