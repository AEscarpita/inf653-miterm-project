<?php

    $data = json_decode(file_get_contents("php://input"));

    //checks to see if all parameteres are entered correctly 
    if(!$data){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }
    if (!$data->quote){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }
    if (!$data->author_id){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }
    if (!$data->category_id){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id; 

    //catches incorrect author_id or category_id values and displays correlating message
    try{
        if($quote->create()){
            $quote->create_find_id();
            echo json_encode($quote);

        }else{
            echo json_encode(array('Message' => 'Quote Not Created'));
        }

    }catch(PDOException $e){
        if(strpos($e->getMessage(), 'qoutes_author_id_key')){
            echo json_encode(array('Message' => "author_id Not Found"));
        }elseif(strpos($e->getMessage(), 'qoutes_category_id_key')){
            echo json_encode(array('Message' => "category_id Not Found"));
        }
    }
    



