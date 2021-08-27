<?php

require "../SharedFiles/databaseConnection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$firstname = trim($_POST['firstname']);
$surname = trim($_POST['surname']);
$email = trim($_POST['email']);
$birthdate = trim($_POST['birthdate']);

$pattern = "^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$";
//Check if all inputs are set and they have proper length
if(!isset($username) || !isset($password) || !isset($firstname) || !isset($surname) || !isset($email) || empty($birthdate) || $username == "" || $password == "" || $firstname == "" || $surname == "" || $email == ""){
   header("Location: ../signUpPage.php?result=empty&username=".$username."&firstname=".$firstname."&surname=".$surname."&email=".$email."");
   exit();
} else if(strlen($username) < 3 || strlen($username) > 15 || strlen($password) < 3 || strlen($password) > 15){
   header("Location: ../signUpPage.php?result=improperLength&username=".$username."&firstname=".$firstname."&surname=".$surname."&email=".$email."");
   exit();
} else{
   $stmt = $conn->query("SELECT * FROM user WHERE username='$username'");
   
   if($rowCount = $stmt->rowCount()){
      if($rowCount == 1){
         header("Location: ../signUpPage.php?result=usernameAlreadyExist&username=".$username."&firstname=".$firstname."&surname=".$surname."&email=".$email."");
         exit();
      } else{
         echo "There multiple users have that username.";
         exit();
      }
   } else{
      //hash password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      //Insert new user
      $sql = "INSERT INTO user VALUES (?,?,?,?,?,?,?,?)";
      $stmt= $conn->prepare($sql);
      $stmt->execute([NULL, $username, $hashedPassword, $firstname, $surname, $email, $birthdate, NULL]);

      //start session
      session_start();
      $_SESSION['username'] = $username;

      //redirect the user
      header("Location: ../index.php");
      exit();
   }
}