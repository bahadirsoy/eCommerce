<?php

//database connection and session
//require "SharedFiles/databaseConnection.php";
session_start();

if(isset($_GET['draw'])) {
    
    $table = "orderdemand";

    // Table's primary key
    $primaryKey = 'orderId';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
        array(
            'db' => 'orderId',
            'dt' => 'DT_RowId',
            'formatter' => function( $d, $row ) {
                // Technically a DOM id cannot start with an integer, so we prefix
                // a string. This can also be useful if you have multiple tables
                // to ensure that the id is unique with a different prefix
                return $d;
            }
        ),
        array(
            'db' => 'orderId',
            'dt' => 0,
            'formatter' => function( $d, $row ) {
                //include database connection
                require "SharedFiles/databaseConnection.php";

                //select order row with id and get column values
                $row = $conn->query("SELECT * FROM orderDemand WHERE orderId='$d'")->fetch();
                $addressId = $row['addressId'];
                $userId = $row['userId'];

                //select address line
                $row = $conn->query("SELECT addressLine FROM address WHERE addressId='$addressId'")->fetch();
                $addressLine = $row['addressLine'];

                //select user values
                $row = $conn->query("SELECT firstname, surname FROM user WHERE id='$userId'")->fetch();
                $firstname = $row['firstname'];
                $surname = $row['surname'];

                //create array
                $array = array($firstname, $surname, $addressLine);

                //return address line
                return $array;
            }
        ),
        array( 
            'db' => 'products', 
            'dt' => 1,
            'formatter' => function($d, $row){
                //include database connection
                require "SharedFiles/databaseConnection.php";

                //encode productIds and quantities
                $products = json_decode($d, true);

                //loop products and get product names
                $string = "";
                foreach($products as $productId => $quantity){
                    //query
                    $row = $conn->query("SELECT productName FROM product WHERE productId='$productId'")->fetch();
                    
                    //add name and quantity to string
                    $string = $string.$row['productName']." x".$quantity."  ";
                }

                return $string;
            }
        ),
        array( 
            'db' => 'orderDate',  
            'dt' => 2,
            'formatter' => function($d, $row){
                //string time to date
                $dateValue = strtotime($d);

                //get day, month and year
                $year = date("Y", $dateValue); 
                $month = date("m", $dateValue); 
                $day = date("d", $dateValue);
                
                //init date string and add day
                $dateString = $day." ";

                //add month name
                switch($month){
                    case 1:
                        $dateString = $dateString."January ";
                        break;
                    case 2:
                        $dateString = $dateString."February ";
                        break;
                    case 3:
                        $dateString = $dateString."March ";
                        break;
                    case 4:
                        $dateString = $dateString."April ";
                        break;
                    case 5:
                        $dateString = $dateString."May ";
                        break;
                    case 6:
                        $dateString = $dateString."June ";
                        break;
                    case 7:
                        $dateString = $dateString."July ";
                        break;
                    case 8:
                        $dateString = $dateString."August ";
                        break;
                    case 9:
                        $dateString = $dateString."September ";
                        break;
                    case 10:
                        $dateString = $dateString."October ";
                        break;
                    case 11:
                        $dateString = $dateString."November ";
                        break;
                    case 12:
                        $dateString = $dateString."December ";
                        break;
                }

                //add year
                $dateString = $dateString.$year;

                //return dateString
                return $dateString;
            }
        ),
        array( 
            'db' => 'status', 
            'dt' => 3,
            'formatter' => function($d, $row){
                switch($d){
                    case 1:
                        return "Order is preparing";
                        break;
                    case 2:
                        return "Order is shipping";
                        break;
                    case 3:
                        return "Order arrived";
                        break;
                    default:
                        return "Error";
                        break;
                }
            }
        ),
        array( 
            'db' => 'orderId', 
            'dt' => 4,
            'formatter' => function($d, $row){
                return '
                <a href="#" class="deleteOrderDemandButton" id='.$d.'>
                    <img src="Resources/deleteOrderDemand.png" alt="invalid path">
                </a>
                ';
            }
        ),
    );
    
    // SQL server connection information
    $sql_details = array(
        'user' => 'root',
        'pass' => '',
        'db'   => 'eticaretdb',
        'host' => 'localhost'
    );
    
    
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    * If you just want to use the basic configuration for DataTables with PHP
    * server-side, there is no need to edit below this line.
    */
    
    require( 'ssp.class.php' );
    
    $id = $_SESSION['id'];
    $where = "userId ='$id'";
    $data = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, $where);

    echo json_encode($data);

    exit;

}
