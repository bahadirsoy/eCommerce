<?php

    //database connection and session
    require "SharedFiles/databaseConnection.php";
    session_start();

?>

<!doctype html>
<html lang="en">

<head>

    <?php 
        require "SharedFiles/headTags.php";
    ?>

    <title>E-Commerce</title>

</head>

<body>

    <?php
        require "SharedFiles/navbar.php";
        
    ?>

    <div class="container">
        <div class="row">
            <?php
                if(isset($_SESSION['cartItems'])){
                    $cartItems = array_count_values($_SESSION['cartItems']);
                    foreach ($cartItems as $productId => $quantity) {
                
                        $row = $conn->query("SELECT * FROM product WHERE productId='$productId'")->fetch();
        
                        echo '
                        <div class="col-12">
                            <h4 class="d-inline">'.$row['productName'].'</h4>
                            <span class="font-weight-bold">x'.$quantity.'</span>
                        </div>
                        ';
                    }
                }
            ?>
            
        </div>
    </div>

    <?php
        $id = $_SESSION['id'];
        $addresses = $conn->query("SELECT * FROM useraddress, address 
        WHERE useraddress.addressid = address.addressid AND 
        useraddress.userid = '$id'")->fetchAll();
        
        $count = 1;
        foreach ($addresses as $row) {
            echo '
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card text-center">
                            <div class="card-header">
                                Address '.$count++.'
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Address Line:</h5>
                                <p class="card-text">'.$row['addressLine'].'</p>
                                <a href="Actions/completeTheOrder.php?addressId='.$row['addressId'].'" class="btn btn-primary">Choose as a address</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    ?>

    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>

</html>