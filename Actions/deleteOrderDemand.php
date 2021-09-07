<?php

    require "../SharedFiles/databaseConnection.php";
    session_start();

    if(isset($_GET['orderId'])){

        $orderId = $_GET['orderId'];

        //Delete order demand query
        $conn->prepare("DELETE FROM orderDemand WHERE orderId=?")->execute([$orderId]);
        
        echo json_encode(array(
            'success' => 1,
        ));

    } else{
        
        echo json_encode(array(
            'success' => 0,
        ));
        
    }