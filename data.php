<?php

//database connection and session
require "SharedFiles/databaseConnection.php";
session_start();


$userId = $_SESSION['id'];
$data = $conn->query("SELECT products, addressLine, orderDate, status FROM orderdemand, address 
        WHERE orderdemand.addressId = address.addressId
        AND orderdemand.userId = '$userId';
        ")->fetchAll();


foreach ($data as $row) {
    echo json_encode($row);
    //var_dump($row);
}

/*for($i=0; $i<count($data); $i++){
    print_r($data[$i]);
}*/