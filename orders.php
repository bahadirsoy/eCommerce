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

    <!--Data table CDN-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.js">
    </script>

    <title>E-Commerce</title>

</head>

<body>

    <?php
        require "SharedFiles/navbar.php";
        
    ?>

    <table id="example" class="ui celled table hover" style="width:100%">
        <thead>
            <tr>
                <th>Products</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>

        <?php

        /*echo '
        <div class="mt-5"></div>
        <table id="example" class="ui celled table hover" style="width:100%">
            <thead>
                <tr>
                    <th>Products</th>
                    <th>Address</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
        ';

        $userId = $_SESSION['id'];
        $data = $conn->query("SELECT * FROM orderdemand, address 
        WHERE orderdemand.addressId = address.addressId
        AND orderdemand.userId = '$userId';
        ")->fetchAll();
        
        foreach ($data as $row) {
            $orderItems = json_decode($row['products'], true);

            echo '
            <tr>
                <td>
            ';
            foreach($orderItems as $productId => $quantity){
                $product = $conn->query("SELECT * FROM product WHERE productId='$productId'")->fetch();

                echo $product['productName'].' x'.$quantity.' ';
            }
            echo '</td>';

            echo '
                <td>'.$row['addressLine'].'</td>
                <td>'.$row['orderDate'].'</td>
                <td>'.$row['status'].'</td>
            </tr>';

        }

        echo '
            </tbody>
        </table>
        ';*/



    ?>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
        </script>

        <script>
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "data.php",
                });
            });
        </script>

</body>

</html>