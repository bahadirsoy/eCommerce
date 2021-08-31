<?php

require "../SharedFiles/databaseConnection.php";
session_start();

if(isset($_GET['column']) && isset($_GET['input'])){
    $column = $_GET['column'];
    $id = $_SESSION['id'];

    switch($column){
        case "username-update-icon":
            $username = $_GET['input'];
            $sql = "UPDATE user SET username=? WHERE id='$id'";
            $conn->prepare($sql)->execute([$username]);

            echo json_encode(array(
                'success' => 1,
            ));
            break;

        default:
            echo json_encode(array(
                'success' => 0,
            ));
            break;
    }
} else{
    echo json_encode(array(
        'success' => 0,
    ));
}