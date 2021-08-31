<?php

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
        
        $cartItems = array_count_values($_SESSION['cartItems']);
        foreach ($cartItems as $productId => $quantity) {
            
            $row = $conn->query("SELECT * FROM product WHERE productId='$productId'")->fetch();

            echo '
            <div class="container col-12 mt-5" style="max-height: 175px;">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="'.$row['productImg'].'" style="max-height: 175px;" class="img-fluid rounded-start" alt="img cannot be found">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2 class="card-title">'.$row['productName'].''."<span class='float-right'>$quantity pieces</span>".'</h2>
                                <p class="card-text mt-5">'.$row['productDescription'].'</p>
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