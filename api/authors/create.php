<?php


$data = json_decode(file_get_contents("php://input"));

if(!$data || $data->author === null){
    echo json_encode(array('Message' => 'Missing parameters'));
    exit();

}

$author->author = $data->author; 



if($author->create()){
    $author->create_find_id();
    echo json_encode(array('Message' => 'created author ( id: ' . $author->id . ' , author: '. $author->author . ' )'));

}else{
    echo json_encode(array('Message' => 'Author Not Created'));
}


    




