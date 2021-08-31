<?php

require "../SharedFiles/databaseConnection.php";
session_start();

if(isset($_GET['productId']) && intval($_GET['productId']) > 0){
    $productId = $_GET['productId'];
    $_SESSION['cartItems'] = array_diff($_SESSION['cartItems'], ["$productId"]);

    echo json_encode(array(
        'success' => 1,
    ));
} else{
    echo json_encode(array(
        'success' => 0,
    ));
}