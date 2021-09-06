<?php

    require "../SharedFiles/databaseConnection.php";
    session_start();

?>

<?php

    if(isset($_POST['productName']) && isset($_POST['productInfo']) && isset($_POST['productDescription']) && isset($_POST['productImg'])){

        //get inputs
        $productName = $_POST['productName'];
        $productInfo = $_POST['productInfo'];
        $productDescription = $_POST['productDescription'];
        $productImg = $_POST['productImg'];

        //Insert product
        $sql = "INSERT INTO product (productId, productName, productInfo, productDescription, productImg) 
        VALUES (?, ?, ?, ?, ?)";
        $conn->prepare($sql)->execute([NULL, $productName, $productInfo, $productDescription, $productImg]);
        
        echo json_encode(array(
            'success' => 1,
        ));
        
    } else{
        
        echo json_encode(array(
            'success' => 0,
        ));
        
    }