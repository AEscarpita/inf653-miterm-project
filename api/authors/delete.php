<?php

$data = json_decode(file_get_contents("php://input"));

if(isVaild($data->id)){
    echo json_encode(array('Message' => 'Missing parameters'));
    exit();
}

$author->id = $data->id;

if($author->delete()){
    echo json_encode(array('Message' => 'Author with id: ' . $author->id . ' Deleted'));

}else{
    echo json_encode(array('Message' => 'No Authors Found'));
}



