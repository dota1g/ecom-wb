<?php 
session_start();
include('config.php');

$emailID = $_GET['id'];

$sql = "UPDATE email set didAdminReadMsg = 1 where emailID = '$emailID'";
mysqli_query($db, $sql);
header("Location:readmsg.php?id=".$emailID."")

?>