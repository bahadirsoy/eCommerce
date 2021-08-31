<?php

    require "../SharedFiles/databaseConnection.php";
    session_start();

?>

<?php

//If cart has no items in it(cart session has not been initialized)
//Init cart session and add that product
if(isset($_GET['productId']) && intval($_GET['productId']) > 0){
    if(!isset($_SESSION['cartItems'])){
        $_SESSION['cartItems'] = array();
    
        $productId = intval($_GET['productId']);
        array_push($_SESSION['cartItems'] ,$productId);

        echo json_encode(array(
            'success' => 1,
        ));

    } else{ //If cart has been already initialized
        //Check that item has already in cart
        $productId = $_GET['productId'];
        array_push($_SESSION['cartItems'] ,$productId);

        echo json_encode(array(
            'success' => 1,
        ));
        
    }
    
    /*$conn->query("INSERT INTO departman
    VALUES (NULL, 'deneme1', 'deneme2', 'deneme3', '0')")->fetch();*/
    
    
} else{
    echo json_encode(array(
        'success' => 0,
    ));
}


