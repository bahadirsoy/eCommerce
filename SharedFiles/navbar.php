<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a href="./index.php" class="navbar-brand">E-Commerce</a>
        <div class="d-flex">
            <?php 

                if(isset($_SESSION['username'])){
                    $id = $_SESSION['id'];
                    $row = $conn->query("SELECT username FROM user WHERE id='$id'")->fetch();
                    echo '
                    <div class="my-auto mr-2"> Welcome '.$row['username'].'
                    </div>';
                }
            ?>
            <a href="./shoppingCart.php" class="btn btn-outline-success mr-2" type="submit">
                Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span href="#" class="badge badge-primary">
                    <?php
                        if(isset($_SESSION['cartItems'])){
                            $cartItems = array_count_values($_SESSION['cartItems']);
                            echo count($cartItems);
                        } else{
                            echo "0";
                        }
                    ?>
                </span>
            </a>
            
            
            <?php
                //If there is an item on the cart
                if(isset($_SESSION['cartItems'])){
                    echo '
                    <a href="Actions/clearCart.php" class="btn btn-outline-warning mr-2" type="button">Clear Cart</a>
                    ';
                }

                //If not logged in yet
                if(!isset($_SESSION['username'])){
                    echo '
                    <a href="./loginPage.php" class="btn btn-outline-info mr-2" type="button">Log in</a>
                    <a href="./signUpPage.php" class="btn btn-outline-secondary mr-2" type="button">Sign up</a>
                    ';
                } else{ //If logged in
                    echo '
                    <a href="./orders.php" class="btn btn-outline-info mr-2" type="button">My Orders</a>
                    <a href="./profile.php" class="btn btn-outline-secondary mr-2" type="button">Profile</a>
                    <a href="Actions/logout.php" class="btn btn-outline-danger mr-2" type="button">Log out</a>
                    ';
                }
            ?>
            
        </div>
    </div>
</nav>