<?php

    //Unset cart session
    session_start();
    session_unset($_SESSION['cartItems']);

    header("Location: ../index.php");

?>