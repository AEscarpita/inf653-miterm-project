<?php

    $data = json_decode(file_get_contents("php://input"));

    //checks if data was entered corrently and if not displays a missing parameteres message 
    if(!$data){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }if(isVaild($data->id)){
        echo json_encode(array('Message' => 'Missing parameters(id must be a number)'));
        exit();
    }
    if (!$data->quote){
        echo json_encode(array('Message' => 'Missing parameters'));
        exit();
    }
    if (isVaild($data->author_id)){
        echo json_encode(array('Message' => 'Missing parameters(author_id must be a number)'));
        exit();
    }
    if (isVaild($data->category_id)){
        echo json_encode(array('Message' => 'Missing parameters(category_id must be a number)'));
        exit();
    }



    $quote->id = $data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    //catches incorrect author_id or category_id values and displays correlating message
    try{
        if($quote->update()){
            echo json_encode(array('Message' => 'Updated quote ( id: ' .  $quote->id . ", quote: " . $quote->quote . ", author_id: " .  $quote->author_id . ", category_id: " . $quote->category_id . ")"));

        }else{
            echo json_encode(array('Message' => 'No quotes Found'));
        }

    }catch(PDOException $e){
        if(strpos($e->getMessage(), 'quotes_author_id')){
            echo json_encode(array('Message' => "author_id Not Found"));
        }elseif(strpos($e->getMessage(), 'quotes_category_id')){
            echo json_encode(array('Message' => "category_id Not Found"));
        }
    }