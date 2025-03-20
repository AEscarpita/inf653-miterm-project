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
    Require_once '../../models/Category.php';
    Require_once '../../functions/isVaild.php';
    


    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);


   if(isset($_GET['id'])){

        $id = $_GET['id'];

        if(isVaild($id)){
            echo json_encode(array('Message' => 'id Must have a int value'));
            exit();
        }

   }

   //if an id value is set requires read_single.php if not requires read.php
    if($method === 'GET'){
        if(isset($_GET['id'])){
            require_once "read_single.php";
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