<?php
header('Content-type: application/json');
include_once '../config/connection.php';
include_once 'functions.php';
try {
$categories = $_GET['categories'];
$sortType = $_GET['sort'];
$searchTerm = $_GET['search'];
$products = [];
$temp = [];
$errNB;

if(strlen($searchTerm) > 30) {
    $response = ['search' => 'Search term too long'];
    echo json_encode($response);
}

$products = getProducts($categories, $sortType, $searchTerm);
echo json_encode($products);
http_response_code(200);


} catch (\PDOException $ex) {
    throw $ex;
    http_response_code(503);
}

?>