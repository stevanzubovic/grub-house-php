<?php
session_start();
    header("Content-type: application/json");   
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      include '../config/connection.php';
      include 'functions.php';
  
      try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $response = ['msg' => ''];
        $emailRegex = '/\S+@\S+\.\S+/';
        
        if(preg_match($emailRegex, $email)){
            $response = ['email' => 'Not a valid email adress'];
        }
        /* if(!)) {
            $response = ['email' => 'No user with that email address'];
            echo http_response_code(403);
        }  */
        $emailEx = userWithEmailExists($email);
        $user = verifyLogin($email, $password);
       
        if($user) {
            $_SESSION['user'] = $user;
            $msg = ['msg' => 'Love you!'];
            echo json_encode($msg);
        } else {
            
            if($emailEx) { 
                $response = ['password' => 'Wrong email/password combination'];
            } else {
                $response = ['email' => 'No user with that email address'];
            }
            echo json_encode($response);
            http_response_code(403); 
        }
          
      } catch (PDOException $exception) {
          echo $exception;
          http_response_code(500);
      }
    } else {
      http_response_code(404);
    }
?>