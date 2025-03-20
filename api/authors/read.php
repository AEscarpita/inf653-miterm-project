<?php

	$result = $author->read();

	$num = $result->rowCount();

	if($num > 0 ){

	$author_arr = array();
	$author_arr['Author Data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)) {

			extract($row);

			$author_item = array(
				'id' => $id,
				'author' => $author
			);

			array_push($author_arr['Author Data'], $author_item);

	}

	

	echo json_encode($author_arr);



	}else{

		echo json_encode(array('Message' => 'author_id Not Found'));

	}
