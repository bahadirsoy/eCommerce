<?php

    //database connection and session
    require "../SharedFiles/databaseConnection.php";
    session_start();

?>

<!doctype html>
<html lang="en">

<head>

    <?php 
        require "../SharedFiles/headTags.php";
    ?>

    <title>E-Commerce</title>

</head>

<body>

    <div class="container mt-5">

        <div class="alert alert-success" role="alert" style="display: none;" id="alert">
            Item has been added to cart succesfully
        </div>

        <form id="form" action="../Actions/addProductAction.php" method="POST">
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Product name">
            </div>
            <div class="form-group">
                <label for="productInfo">Product Info:</label>
                <input type="text" class="form-control" id="productInfo" name="productInfo" placeholder="Product info">
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description:</label>
                <input type="text" class="form-control" id="productDescription" name="productDescription" placeholder="Product description">
            </div>
            <div class="form-group">
                <label for="productImage">Product Image:</label>
                <input type="text" class="form-control" id="productImage" name="productImage" placeholder="Product image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        //ajax request if user adds product to cart
        $(document).ready(function () {
            $('#form').submit(function (e) {
                e.preventDefault();
                //console.log($(this).serialize());
                $.ajax({
                    type: "POST",
                    url: '../Actions/addProductAction.php',
                    data: $('#form').serialize(),
                }).then(
                    // resolve/success callback
                    function (response) {
                        var jsonData = JSON.parse(response);
                        
                        // user has added the product successfully
                        if (jsonData.success == "1") {
                            console.log(jsonData.inputs);
                            $('#alert').css("display", "block");
                        } else if (jsonData.success == "0") {
                            alert('There was some error!');
                        } else {
                            alert('Invalid Credentials!');
                        }
                    },
                    // reject/failure callback
                    function () {
                        alert('Reject/failure callback!');
                    }
                );
            });
        });
    </script>

</body>

</html>