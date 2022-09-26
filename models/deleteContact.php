<?php
session_start();
try {
    header('Content-type: application/json');
    include_once '../config/connection.php';
    include_once 'functions.php';
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->roleId == '1') {
            $id = $_POST['id'];
            $response = deleteContact($id);
            if($response) {
                $msg = ['msg' => 'Contact message successfully deleted'];
                echo json_encode($msg);
            } else {
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