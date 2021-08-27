<?php

    //Unset cart session
    session_start();
    unset($_SESSION['cartItems']);

    header("Location: ../index.php");

?>