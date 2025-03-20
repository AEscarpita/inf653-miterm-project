<?php


    $data = json_decode(file_get_contents("php://input"));

    if(!$data){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }else if (isVaild($data->id)){
        echo json_encode(array('Message' => 'Missing parameters(id must be a number)'));
        exit();
    }else if ($data->author === null){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }


    $author->id = $data->id;

    $author->author = $data->author; 

    if($author->update()){
        echo json_encode(array('Message' => 'Updated author ( id: ' .  $author->id . ", author: " . $author->author .  ")"));

    }else{
        echo json_encode(array('Message' => 'Author not Updated'));
    }

