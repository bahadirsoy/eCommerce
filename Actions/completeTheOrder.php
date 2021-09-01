<?php

    //database connection and session
    require "../SharedFiles/databaseConnection.php";
    session_start();

    if(isset($_SESSION['cartItems']) & isset($_GET['addressId'])){
        $id = $_SESSION['id'];
        $row = $conn->query("SELECT * FROM user WHERE id='$id'")->fetch();

        $userId = $_SESSION['id'];
        $addressId = $_GET['addressId'];
        $products = json_encode(array_count_values($_SESSION['cartItems']));
        $status = 1;

        $sql = "INSERT INTO orderdemand (orderId, userId, addressId, products, orderDate, status) VALUES (?, ?, ?, ?, ?, ?)";
        $conn->prepare($sql)->execute([NULL, $userId, $addressId, $products, NULL, $status]);

        //Unset cart session
        unset($_SESSION['cartItems']);

        header("Location: ../index.php");
        exit();
    } else{
        echo "There is no item in the cart. You cannot complete order";
        exit();
    }