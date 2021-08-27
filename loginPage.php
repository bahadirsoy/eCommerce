<?php

    require "SharedFiles/databaseConnection.php";

?>

<!doctype html>
<html lang="en">

<head>

    <?php 
        require "SharedFiles/headTags.php";
    ?>

    <title>E-Commerce</title>

    <style>
    body {
        background-color: #5286F3;
        font-size: 14px;
        color: #fff;
    }

    .simple-login-container {
        width: 300px;
        max-width: 100%;
        margin: 0px auto;
        margin-top: 10%;
    }

    .simple-login-container h2 {
        text-align: center;
        font-size: 20px;
    }

    .simple-login-container .btn-login {
        background-color: #FF5964;
        color: #fff;
    }

    a {
        color: #fff;
    }
    </style>

</head>

<body>
    <div class="container">
        <form action="Control/loginControl.php" method="POST">
            <div class="simple-login-container">
                <h2>Login</h2>
                <div class="row mt-5">
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username"
                        value="<?php if(isset($_GET['username'])) echo $_GET['username']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="password" placeholder="Enter your Password" class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="submit" class="btn btn-block btn-login" value="Log in">
                    </div>
                </div>
                <div class="row">
                    <a class="font-weight-bold " href="./signUpPage.php">Don't have an account yet ?</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>

</html>