<?php
include_once '../includes/session_Include.php';
include_once '../classes/db_connect.php';
include_once '../classes/productDAO.php';

$productName = $_POST["product_name"];
$price = $_POST["price"];
$imageName = $_POST["image_name"];
$shortDesc = $_POST["short_description"];
$longDesc = $_POST["long_description"];
$category = $_POST["category"];
$inventory = $_POST["inventory"];

$dao = new productDAO();

$dao->createProduct($productName, $price, $imageName, $shortDesc, $longDesc, $category, $inventory);

header("refresh:2;../pages/admin_home.php");
?>