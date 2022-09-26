<?php 
header('Content-type: application/json');
include_once '../config/connection.php';
include_once 'functions.php';
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $emailRegex = '/\S+@\S+\.\S+/';
        $errNb = 0;
       
        if (!preg_match($emailRegex, $email)) {
            $errNb++;
           
        }
        if(!strlen($name) > 2 || !strlen($name) > 30 || !is_string($name)) { 
            $errNb++;
             
        }
        if($message == '' || strlen($message) > 500) {
            $errNb++;
        }
           
        if($errNb == 0) {
            if(insertContact($name, $email, $message)) {
                $response = ['msg' => 'Thank you for contacting us'];
                echo json_encode($response);
                http_response_code(201);
            } else {
                $response = ['msg' => 'Something went wrong'];
                //echo json_encode($response);
            }

        }
    } catch (\Throwable $th) {
        //throw $th;
        http_response_code(503);
    }
?>