<?php

require "../SharedFiles/databaseConnection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$firstname = trim($_POST['firstname']);
$surname = trim($_POST['surname']);
$email = trim($_POST['email']);
$date = trim($_POST['date']);

//Check if all inputs are set
if(!isset($username) || !isset($password) || !isset($firstname) || !isset($surname) || !isset($email) || !isset($date) || $username == "" || $password == "" || $firstname == "" || $surname == "" || $email == ""){
   header("Location: ../signUpPage.php?result=empty&username=".$username."&firstname=".$firstname."&surname=".$surname."&email".$email."");
   exit();
} else{

}