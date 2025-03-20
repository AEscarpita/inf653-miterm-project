<?php

    $data = json_decode(file_get_contents("php://input"));

    //checks if data was entered corrently and if not displays a missing parameteres message 
    //checks that there is an entered category and if there is not displays a message
    if(!$data || $data === "{}"  ){
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
    }
    if(!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)){
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
    }



    $quote->id = $data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    //catches incorrect author_id or category_id values and displays correlating message
    try{
        if($quote->update()){
            echo json_encode($quote);

        }else{
            echo json_encode(array('message' => 'No Quotes Found'));
        }

    }catch(PDOException $e){
        if(strpos($e->getMessage(), 'qoutes_author_id_key')){
            echo json_encode(array('message' => "author_id Not Found"));
        }elseif(strpos($e->getMessage(), 'qoutes_category_id_key')){
            echo json_encode(array('message' => "category_id Not Found"));
        }
    }