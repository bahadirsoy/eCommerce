<?php

    require "../SharedFiles/databaseConnection.php";
    session_start();

?>

<?php

    if(true){
        
        echo json_encode(array(
            'success' => 1,
            'inputs' => $_POST,
        ));
        
    } else{
        
        echo json_encode(array(
            'success' => 0,
        ));
        
    }