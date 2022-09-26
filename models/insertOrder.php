<?php

try {    
    session_start();
    //header('Content-type: application/json');
    require_once "functions.php";
    include_once '../config/connection.php';

    if(isset($_SESSION['user'])) {
        $productQuantityPairs = $_POST['data'];

        $orderId = insertOrder($_SESSION['user']->roleId);

        foreach($productQuantityPairs as $productQuantityPair) {
            insertReciept($productQuantityPair, $orderId);
        }

    }
   

   

} catch(PDOException $ex) {
    echo $ex;
    //return http_response_code(500);
}

?>