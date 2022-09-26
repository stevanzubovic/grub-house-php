<?php
session_start();
try {
    header('Content-type: application/json');
    include_once '../config/connection.php';
    include_once 'functions.php';
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->roleId == '1') {
            $id = $_POST['id'];
            $response = deleteCategory($id);
            if($response) {
                $msg = ['msg' => 'Category successfully deleted'];
                echo json_encode($msg);
            } else {
                http_response_code(409);
                $msg = ['msg' => 'Operation unsuccesful'];
                echo json_encode($msg);
            }
            
        }
    } else {
        header('Location: ../404.php');
    }
} catch (\Throwable $th) {
    //throw $th;
}
?>