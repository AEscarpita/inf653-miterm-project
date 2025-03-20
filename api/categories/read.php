<?php


	$result = $category->read();

	$num = $result->rowCount();

	if($num > 0 ){

	$categroy_arr = array();
	$category_arr['Category Data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)) {

			extract($row);

			$category_item = array(
				'id' => $id,
				'category' => $category
			);

			array_push($category_arr['Category Data'], $category_item);

	}

	

	echo json_encode($category_arr);



	}else{

		echo json_encode(array('Message' => 'category_id Not Found'));

	}


