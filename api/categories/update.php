<?php

 

$data = json_decode(file_get_contents("php://input"));

if(!$data){
    echo json_encode(array('Message' => 'Missing parameters'));
    exit();
}else if (isVaild($data->id)){
    echo json_encode(array('Message' => 'Missing parameters (id must be a number)'));
    exit();
}else if ($data->category === null){
    echo json_encode(array('Message' => 'Missing parameters'));
    exit();
}


$category->id = $data->id;

$category->category = $data->category; 

if($category->update()){
    echo json_encode(array('Message' => 'Updated category ( id: ' .  $category->id . ', category: ' . $category->category .  ')'));

}else{
    
    echo json_encode(array('Message' => 'Category not Updated'));
}

