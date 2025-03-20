<?php

//Gets all quote data for a given category_id and displays it 

$quote->category_id = $_GET['category_id'];

$result = $quote->read_group_category();

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

    echo json_encode(array('Message' => 'No Quotes Found'));

}
