<?php
/*$hashedpass = password_hash("123", PASSWORD_DEFAULT);
exit($hashedpass);*/
require "../SharedFiles/databaseConnection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

if (!isset($username) || !isset($password) || $username==="" || $password==="") {

    header("Location: ../loginPage.php?result=empty&username=".$username);
    exit();
  
} else{
    $stmt = $conn->query("SELECT * FROM user WHERE username='$username'");

    if($rowCount = $stmt->rowCount()){
        if($rowCount > 0){
            $user = $stmt->fetch();
            //exit(password_verify($user['password'], $password));
            if(password_verify($password, $user['password'])){
                session_start();
                $_SESSION['username']=$username;
                $_SESSION['password']=$password;
                
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