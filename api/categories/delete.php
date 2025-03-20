<?php


    $data = json_decode(file_get_contents("php://input"));

    if(isVaild($data->id)){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }

    $category->id = $data->id;

    if($category->delete()){
        echo json_encode(array('id' => $category->id));

    }else{
        echo json_encode(array('Message' => 'No Categories Found'));
    }



