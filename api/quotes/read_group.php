<?php

//Gets all quote data for a given category_id and author_id and displays it 

$quote->author_id = $_GET['author_id'];

$quote->category_id = $_GET['category_id'];

$result = $quote->read_group();

$num = $result->rowCount();

if($num > 0 ){

$quote_arr = array();
$quote_arr['Quote Data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        );

        array_push($quote_arr['Quote Data'], $quote_item);

}



echo json_encode($quote_arr);



}else{

    echo json_encode(array('Message' => 'Quotes Not Found'));

}