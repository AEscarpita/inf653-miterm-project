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

$category->category = $data->category; 


if($category->create()){
    $category->create_find_id();
    echo json_encode($category);

}else{
    echo json_encode(array('Message' => 'Category Not Created'));
}





