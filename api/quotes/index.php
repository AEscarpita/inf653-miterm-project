<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    Require_once '../../config/Database.php';
    Require_once '../../models/Quote.php';
    Require_once '../../functions/isVaild.php';


    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    //checks that id is a number
   if(isset($_GET['id'])){

        $id = $_GET['id'];

        if(isVaild($id)){
            echo json_encode(array('Message' => 'id Must have a int value'));
            exit();
        }

   }

   //checks that author_id is a number
   if(isset($_GET['author_id'])){

    $author_id = $_GET['author_id'];

    if(isVaild($author_id)){
        echo json_encode(array('Message' => 'author_id Must have a int value'));
        exit();
    }

    }

    //checks that category_id is a number 
    if(isset($_GET['category_id'])){

        $category_id = $_GET['category_id'];

        if(isVaild($category_id)){
            echo json_encode(array('Message' => 'category_id Must have a int value'));
            exit();
        }

   }

    //uses different files depending if id, author_id, or category_id is set or not 
    if($method === 'GET'){
        if(isset($_GET['id'])){
            require_once "read_single.php";
        }elseif (isset($_GET['author_id']) && isset($_GET['category_id'])){
            require_once "read_group.php";
        }elseif (isset($_GET['author_id'])){
            require_once "read_group_author.php";
        }elseif (isset($_GET['category_id'])){
            require_once "read_group_category.php";
        }else{
            require_once 'read.php';
        }
        
    }

    if($method === 'PUT'){
        require_once 'update.php';
    }

    if($method === 'POST'){
        require_once 'create.php';
    }

    if($method === 'DELETE'){
        require_once 'delete.php';
    }