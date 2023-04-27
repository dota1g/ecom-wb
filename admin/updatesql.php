<?php
session_start();
include("config.php");
$productID = $_GET['prodID'];

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (
    isset($_GET['name']) && isset($_GET['shortdesc']) && isset($_GET['description']) &&
    isset($_GET['price']) && isset($_GET['available'])
) {
    $productName = test_input($_GET['name']);
    $productSD = test_input($_GET['shortdesc']);
    $productDesc = test_input($_GET['description']);
    $productPrice = test_input($_GET['price']);
    $isProductAvailable = test_input($_GET['available']);
    $success = true;
}


if ($success) {
    $sql = "UPDATE products
            SET productName = '$productName', 
                productShortDesc = '$productSD', 
                productDesc = '$productDesc', 
                productPrice = '$productPrice', 
                isProductAvailable ='$isProductAvailable'
            WHERE productID = '$productID'";
    $result = mysqli_query($db, $sql) or die ("this stuffedup"); 
    header('location:deleteservice.php');
    exit();
}
