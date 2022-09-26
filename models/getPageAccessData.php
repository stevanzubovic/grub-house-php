<?php   
    $file = file('../data/pageAccess.txt');
    $response = [];
    foreach($file as $key => $row) {
        $data = explode('__', $row);
        //var_dump(strtotime($data[1]));
        array_push($response, $data);
    }
    echo json_encode($response);


