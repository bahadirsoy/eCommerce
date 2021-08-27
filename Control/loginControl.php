<?php

require "../SharedFiles/databaseConnection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

//Check if all inputs are set
if (!isset($username) || !isset($password) || $username==="" || $password==="") {

    header("Location: ../loginPage.php?result=empty&username=".$username);
    exit();
  
} else{//If so, check if that user exist
    $stmt = $conn->query("SELECT * FROM user WHERE username='$username'");

    if($rowCount = $stmt->rowCount()){
        if($rowCount > 0){
            $user = $stmt->fetch();
            
            //verify password(hashed password)
            if(password_verify($password, $user['password'])){
                //correct info, start sessions and log in
                session_start();
                $_SESSION['username']=$username;
                
                header("Location: ../index.php");
            } else{
                header("Location: ../loginPage.php?result=incorrectPassword&username=".$username);
                exit();
            }
        } else{
            header("Location: ../loginPage.php?result=incorrectInfo&username=".$username);
            exit();
        }
    } else{
        header("Location: ../loginPage.php?result=incorrectInfo&username=".$username);
        exit();
    }
}