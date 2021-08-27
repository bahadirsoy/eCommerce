<?php

//Init all database variables
$servername = "localhost";
$username = "root";
$password = "";

//Create connection
$conn = new PDO("mysql:host=$servername;dbname=eticaretdb", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
