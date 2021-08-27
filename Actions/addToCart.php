<?php

    require "../SharedFiles/databaseConnection.php";
    session_start();

?>

<?php

if(!isset($_SESSION['cartItems'])){
    $_SESSION['cartItems'] = array();

    $productId = $_GET['productId'];
    $row = $conn->query("SELECT * FROM product WHERE productId='$productId'")->fetch();
    $productName = $row['productName'];

    $_SESSION['cartItems'][$productName] = 1;
    
} else{
    $productId = $_GET['productId'];
    $row = $conn->query("SELECT * FROM product WHERE productId='$productId'")->fetch();
    $productName = $row['productName'];

    if(isset($_SESSION['cartItems'][$productName])){
        //echo '<script>console.log("already defined");</script>';
        $count = $_SESSION['cartItems'][$productName];
        $_SESSION['cartItems'][$productName] = $count + 1;
    } else{
        //echo '<script>console.log("not defined");</script>';
        $_SESSION['cartItems'][$productName] = 1;
    }
    
}

/*$conn->query("INSERT INTO departman
VALUES (NULL, 'deneme1', 'deneme2', 'deneme3', '0')")->fetch();*/

echo json_encode(array(
    'success' => 1,
));
