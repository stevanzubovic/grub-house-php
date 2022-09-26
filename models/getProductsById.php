<?php
header('Content-type: application/json');
include_once '../config/connection.php';
include_once 'functions.php';
try {
$ids = $_GET['ids'];

$products = [];
 foreach($ids as $id) {
    if(is_numeric($id)) {
      array_push($products, getProductsById($id));
    }
} 
echo json_encode($products);
http_response_code(200);


} catch (\PDOException $ex) {
    //throw $th;
    http_response_code(503);
}

?>