<?php


    $data = json_decode(file_get_contents("php://input"));

    //checks that there is an entered category and if there is not displays a message
    if(!$data || $data === "{}"  ){
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();

    }    
    if(!isset($data->category)){
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
    }


    $author->id = $data->id;

    $author->author = $data->author; 

    if($author->update()){
        echo json_encode(array('Message' => 'Updated author ( id: ' .  $author->id . ", author: " . $author->author .  ")"));

    }else{
        echo json_encode(array('Message' => 'Author not Updated'));
    }

