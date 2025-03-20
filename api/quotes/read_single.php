<?php

//Gets all quote data for a given id and displays it 

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

	$result = $quote->read_single();

	echo json_encod($result);

	$quote->quote = $result['quote']; 
	$author->author = $result->['author'];
	$category->categor = $result['category'];

	$quote_arr = array(
    	'id' => (int)$quote->id,
        'quote'=> $quote->quote,
        'author'=> $author->author,
    	'category' => $category->category
	);

    print_r(json_encode($quote_arr));