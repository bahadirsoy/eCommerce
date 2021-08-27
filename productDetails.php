<?php
    require "SharedFiles/databaseConnection.php";
    session_start();
?>

<!DOCTYPE html>
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

    <?php
        $productId = $_GET['id'];
        $row = $conn->query("SELECT * FROM product WHERE productId=$productId")->fetch();

        echo '
        <div class="container col-12">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="'.$row['productImg'].'" class="img-fluid rounded-start" alt="img cannot be found">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">'.$row['productName'].'</h2>
                            <p class="card-text mt-5">'.$row['productDescription'].'</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    ?>


</body>

</html>