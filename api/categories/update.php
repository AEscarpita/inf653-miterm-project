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

$category->id = $data->id;

$category->category = $data->category; 

if($category->update()){
    echo json_encode(array('Message' => 'Updated category ( id: ' .  $category->id . ', category: ' . $category->category .  ')'));

}else{
    
    echo json_encode(array('Message' => 'Category not Updated'));
}

