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

        echo '
        <div class="alert alert-warning mt-4" role="alert" style="display: none;" id="alert">
            Item has been removed to cart succesfully
        </div>
        ';
        
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
                        <div class="col-md-8"
                            <div class="card-body">
                                <a class="remove-item" style="color: red;" href="#" id='.$row['productId'].'> <i class="far fa-times-circle float-right mt-3 mr-3 fa-3x"></i> </a>
                                <h2 class="card-title mr-5 mt-5">'.$row['productName'].''."<span class='float-right mr-5'>$quantity pieces</span>".'</h2>
                                <p class="card-text mt-5">'.$row['productDescription'].'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    ?>

    <div class="d-flex">
        <a href="./completeTheOrder.php" type="button" class="btn btn-success btn-lg mx-auto mt-4">Complete the
            order</a>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        //ajax request if user adds product to cart
        $(document).ready(function () {
            $('.remove-item').click(function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $.ajax({
                    type: "POST",
                    url: 'Actions/removeItem.php?productId=' + id,
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
                            $('#' + id).parent().parent().parent().parent().remove();
                            //console.log(1);
                        } else if (jsonData.success == "0") {
                            alert('There was some error!');
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