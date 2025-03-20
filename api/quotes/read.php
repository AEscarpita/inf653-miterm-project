<?php

	//Gets all qoute data and dispalys it 

	$result = $quote->read();

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

