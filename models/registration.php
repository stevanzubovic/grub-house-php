<?php
header('Cnontent-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/connection.php';
    include 'functions.php';

    try {
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $roleId = 2;
        $emailRegex = '/\S+@\S+\.\S+/';
        $errNb = 0;
        $emailEx = false;
        $response = ['msg' => 'Sucess'];

        if (!preg_match($emailRegex, $email)) {
            $errNb++;
        }
        if (strlen($password) < 8) {
            $errNb++;
        }
        if (userWithEmailExists($email)) {
            $response = ['email' => 'A user with the given email already exists'];
            $emailEx = true;
        }
        if (isset($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            //var_dump($hashedPassword);
        } else {
        }
        if ($emailEx) {
            echo json_encode($response);
            http_response_code(403);
        } else {
            $isInsertSuccessfull = insertUser($userName, $email, $hashedPassword, $roleId);
            if ($isInsertSuccessfull) {
                echo json_encode($response);
                http_response_code(201);
            }
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo $e;
    }
}
