<?php

    require "../SharedFiles/databaseConnection.php";
    session_start();

?>

<?php

//If cart has no items in it(cart session has not been initialized)
//Init cart session and add that product
if(!isset($_SESSION['cartItems'])){
    $_SESSION['cartItems'] = array();

    $productId = $_GET['productId'];
    $row = $conn->query("SELECT * FROM product WHERE productId='$productId'")->fetch();
    $productName = $row['productName'];

    $_SESSION['cartItems'][$productName] = 1;
    
} else{ //If cart has been already initialized
    //Check that item has already in cart
    $productId = $_GET['productId'];
    $row = $conn->query("SELECT * FROM product WHERE productId='$productId'")->fetch();
    $productName = $row['productName'];

    //If cart has that item, change quantity
    if(isset($_SESSION['cartItems'][$productName])){
        //echo '<script>console.log("already defined");</script>';
        $count = $_SESSION['cartItems'][$productName];
        $_SESSION['cartItems'][$productName] = $count + 1;
    } else{ //If cart has not that item, add it
        //echo '<script>console.log("not defined");</script>';
        $_SESSION['cartItems'][$productName] = 1;
    }
    
}

/*$conn->query("INSERT INTO departman
VALUES (NULL, 'deneme1', 'deneme2', 'deneme3', '0')")->fetch();*/

echo json_encode(array(
    'success' => 1,
));
