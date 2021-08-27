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

        echo print_r($_SESSION['cartItems']); //For debug
    ?>

    <div class="container mt-5">
        <div class="row">

            <div class="alert alert-success" role="alert" style="display: none;" id="alert">
                Item has been added to cart succesfully
            </div>

            <?php
                    $stmt = $conn->query("SELECT * FROM product");
                    while ($row = $stmt->fetch()) {
                        echo '
                        <div class="col-4">
                            <div class="card">
                                <img src="'.$row["productImg"].'"
                                class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href=""><h5 class="card-title">'.$row["productName"].'</h5></a>
                                    <p class="card-text">'.$row['productInfo'].'</p>
                                    <a id="'.$row['productId'].'" href="" class="btn btn-success addToCartButton">Add to cart</a>
                                    <a href="productDetails.php?id='.$row['productId'].'" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        //ajax request if user adds product to cart
        $(document).ready(function () {
            $('.addToCartButton').click(function (e) {
                //console.log($(this).serialize());
                e.preventDefault();
                var id = $(this).attr("id");
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: 'Actions/addToCart.php?productId=' + id,
                    data: ""
                }).then(
                    // resolve/success callback
                    function (response) {
                        var jsonData = JSON.parse(response);

                        // user has added the product successfully
                        // let's redirect
                        if (jsonData.success == "1") {
                            //location.href = 'my_profile.php'
                            //$('#blank').val(jsonData['password']);

                            $('#alert').css("display", "block");
                            console.log(jsonData);
                        } else {
                            alert('Invalid Credentials!');
                        }
                    },
                    // reject/failure callback
                    function () {
                        alert('There was some error!');
                    }
                );
            });
        });
    </script>

</body>

</html>