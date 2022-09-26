<?php
header('Content-type: application/json');
include_once '../config/connection.php';
include_once 'functions.php';
session_start();
try {
    $surveyId = $_POST['surveyId'];
    $answerId = $_POST['answerId'];
    $userId = $_SESSION['user']->userId;


    if(is_numeric($surveyId) && is_numeric($answerId)) {
        if(!userAlreadyAnswered($surveyId, $userId)) {
            if(doesAnswerBelongToSurvey($answerId, $surveyId)) {
                $isOK = insertAnswerSurveyUser($answerId, $surveyId, $userId);
                $response = ['msg' => 'Sucess'];
                echo json_encode($response);
            }
        } else {
            $response = ['error' => 'You have already answered'];
            echo json_encode($response);
            http_response_code(403);
        }
       
    }
} catch (\PDOException $ex) {
    echo $ex;

}

?>