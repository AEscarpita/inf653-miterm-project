<?php

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

	$author->read_single();

	$author_arr = array(
    	'id' => (int) $author->id,
    	'author' => $author->author
	);

    print_r(json_encode($author_arr));