<?php


$data = json_decode(file_get_contents("php://input"));

if(!$data || $data === "{}"  ){
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}
if(!isset($data->author)){
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}

$author->author = $data->author; 



if($author->create()){
    $author->create_find_id();    
    echo json_encode($author);

}else{
    echo json_encode(array('Message' => 'Author Not Created'));
}


    




