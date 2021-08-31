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

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">

                <div class="alert alert-success" role="alert" style="display: none;" id="alert">
                    Profile has been updated successfully
                </div>

                <div class="form-group">
                    <label class="d-block" for="username">Username</label>
                    <input type="text" class="form-control d-inline w-75" id="username" name="username" value="<?php
                        $id = $_SESSION['id'];
                        $row = $conn->query("SELECT username FROM user WHERE id='$id'")->fetch();
                        echo $row['username'];
                    ?>">
                    <span style="color: green;">
                        <a class="username-update-icon" href="#">
                            <i class="fa fa-check fa-2x ml-3 update-icon" aria-hidden="true" data-toggle="tooltip"
                                data-placement="left" title="Update email"></i>
                        </a>
                    </span>
                </div>
                <div class="form-group">
                    <label class="d-block" for="password">Password</label>
                    <input type="password" class="form-control d-inline w-75" id="password" name="password">
                    <span style="color: green;">
                        <a class="password-update-icon" href="">
                            <i class="fa fa-check fa-2x ml-3 update-icon" aria-hidden="true" data-toggle="tooltip"
                                data-placement="left" title="Update email"></i></a>
                    </span>
                </div>
                <div class="form-group">
                    <label class="d-block" for="firstname">First name</label>
                    <input type="text" class="form-control d-inline w-75" id="firstname" name="firstname" value="<?php
                        $id = $_SESSION['id'];
                        $row = $conn->query("SELECT firstname FROM user WHERE id='$id'")->fetch();
                        echo $row['firstname'];
                    ?>">
                    <span style="color: green;">
                        <a class="firstname-update-icon" href="">
                            <i class="fa fa-check fa-2x ml-3 update-icon" aria-hidden="true" data-toggle="tooltip"
                                data-placement="left" title="Update email"></i></a>
                    </span>
                </div>
                <div class="form-group">
                    <label class="d-block" for="surname">Surname</label>
                    <input type="text" class="form-control d-inline w-75" id="surname" name="surname" value="<?php
                        $id = $_SESSION['id'];
                        $row = $conn->query("SELECT surname FROM user WHERE id='$id'")->fetch();
                        echo $row['surname'];
                    ?>">
                    <span style="color: green;">
                        <a class="surname-update-icon" href="">
                            <i class="fa fa-check fa-2x ml-3 update-icon" aria-hidden="true" data-toggle="tooltip"
                                data-placement="left" title="Update email"></i></a>
                    </span>
                </div>
                <div class="form-group">
                    <label class="d-block" for="email">E-mail</label>
                    <input type="email" class="form-control d-inline w-75" id="email" name="email" value="<?php
                        $id = $_SESSION['id'];
                        $row = $conn->query("SELECT email FROM user WHERE id='$id'")->fetch();
                        echo $row['email'];
                    ?>">
                    <span style="color: green;">
                        <a class="email-update-icon" href="">
                            <i class="fa fa-check fa-2x ml-3 update-icon" aria-hidden="true" data-toggle="tooltip"
                                data-placement="left" title="Update email"></i></a>
                    </span>
                </div>
                <div class="form-group">
                    <label class="d-block" for="birthdate">BirthDate</label>
                    <input type="text" class="form-control d-inline w-75" id="birthdate" name="birthdate" readonly
                        value="<?php
                        $id = $_SESSION['id'];
                        $row = $conn->query("SELECT birthdate FROM user WHERE id='$id'")->fetch();
                        echo date('d-m-Y', strtotime($row['birthdate']));
                    ?>">
                </div>
                <div class="form-group">
                    <label class="d-block" for="registerdate">Register Date</label>
                    <input type="text" class="form-control d-inline w-75" id="registerdate" name="registerdate" readonly
                        value="<?php
                        $id = $_SESSION['id'];
                        $row = $conn->query("SELECT registerdate FROM user WHERE id='$id'")->fetch();
                        echo date('d-m-Y', strtotime($row['registerdate']));
                    ?>">
                </div>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        //ajax request if user updates username
        $(document).ready(function () {
            $('.update-icon').click(function (e) {
                e.preventDefault();
                var column = $(this).parent().attr("class");
                var input = $(this).parent().parent().prev().val();
                $.ajax({
                    type: "POST",
                    url: 'Actions/updateUser.php?column=' + column + '&input=' + input,
                    data: ""
                }).then(
                    // resolve/success callback
                    function (response) {
                        var jsonData = JSON.parse(response);

                        if (jsonData.success == "1") {

                            $('#alert').css("display", "block");

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