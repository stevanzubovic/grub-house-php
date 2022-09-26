<?php
try {
    include_once '../config/connection.php';
    include_once 'functions.php';

    $name = $_POST['name'];
    $categoryId = $_POST['categoryId'];
    $priceId = $_POST['priceId'];
    $description = $_POST['description'];
    $id = $_POST['id'];
    $message = "";

    if(empty($priceId) || empty($categoryId)) {
        http_response_code(400);
        $message = ['msg' => 'Could not update'];
        header('Content-type: application/json');
        echo json_encode($message);
        
    } else {
        //echo 'dasd';
        $successful = updateProduct($id, $name, $categoryId, $priceId, $description);
        if($successful) {
            $message = ['message' => 'Updated successfully'];
            header('Content-type: application/json');
            echo json_encode($message);
        }
    }
  
   // echo $successful;

} catch (\PDOException $ex) {
    http_response_code(500);
}
