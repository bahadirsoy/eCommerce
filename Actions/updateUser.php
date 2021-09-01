<?php

require "../SharedFiles/databaseConnection.php";
session_start();

if(isset($_GET['column']) && isset($_GET['input'])){
    $column = $_GET['column'];
    $id = $_SESSION['id'];

    switch($column){
        case "username-update-icon":
            $input = $_GET['input'];
            $sql = "UPDATE user SET username=? WHERE id='$id'";
            $conn->prepare($sql)->execute([$input]);

            echo json_encode(array(
                'success' => 1,
            ));
            break;

        case "password-update-icon":
            $input = $_GET['input'];
            $hashedPassword = password_hash($input, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET password=? WHERE id='$id'";
            $conn->prepare($sql)->execute([$hashedPassword]);

            echo json_encode(array(
                'success' => 1,
            ));
            break;

        case "firstname-update-icon":
            $input = $_GET['input'];
            $sql = "UPDATE user SET firstname=? WHERE id='$id'";
            $conn->prepare($sql)->execute([$input]);

            echo json_encode(array(
                'success' => 1,
            ));
            break;

        case "surname-update-icon":
            $input = $_GET['input'];
            $sql = "UPDATE user SET surname=? WHERE id='$id'";
            $conn->prepare($sql)->execute([$input]);

            echo json_encode(array(
                'success' => 1,
            ));
            break;

        case "email-update-icon":
            $input = $_GET['input'];
            $sql = "UPDATE user SET email=? WHERE id='$id'";
            $conn->prepare($sql)->execute([$input]);

            echo json_encode(array(
                'success' => 1,
            ));
            break;

        case "address-add-icon":
            $input = $_GET['input'];
            $sql = "INSERT INTO address (addressId, addressLine) VALUES (?, ?)";
            $conn->prepare($sql)->execute([NULL, $input]);

            $addressId = $conn->lastInsertId();

            $id = $_SESSION['id'];
            $sql = "INSERT INTO useraddress (id, userId, addressId) VALUES (?, ?, ?)";
            $conn->prepare($sql)->execute([NULL, $id, $addressId]);

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