<?php
session_start();
try {
    header('Content-type: application/json');
    include_once '../config/connection.php';
    include_once 'functions.php';
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->roleId == '1') {
            $response = getAllProducts();
            echo json_encode($response);
        }
    } else {
        header('Location: ../404.php');
    }
} catch (\Throwable $th) {
    //throw $th;
}
?>