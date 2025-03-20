<?php


$data = json_decode(file_get_contents("php://input"));

if(!$data || $data->author === null){
    echo json_encode(array('Message' => 'Missing parameters'));
    exit();

}

$author->author = $data->author; 

$created_author = array();

if($author->create()){
    $author->create_find_id();
    $author_item = array(
        'id' => $author->id,
        'author' => $author->author
    );
    array_push($created_author, $author_item);
    echo json_encode($createdAuthor);

}else{
    echo json_encode(array('Message' => 'Author Not Created'));
}


    




