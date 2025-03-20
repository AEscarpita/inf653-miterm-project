<?php


    $data = json_decode(file_get_contents("php://input"));

    if(isVaild($data->id)){
        echo json_encode(array('Message' => 'Missing id (id must be a number)'));
        exit();
    }

    $quote->id = $data->id;

    if($quote->delete()){
        echo json_encode(array('id' => $quote->id));

    }else{
        echo json_encode(array('message' => 'No Quotes Found'));
    }


