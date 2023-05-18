<?php
session_start();
include('config.php');

$productID = $_GET['id'];

$del = "DELETE FROM products where productID = '$productID'";
mysqli_query($db, $del);
header('Location:deleteservice.php');