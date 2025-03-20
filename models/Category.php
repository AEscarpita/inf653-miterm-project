<?php

class Category {


    private $conn;
    private $table = 'categories';

    //Category Properties
    public $id;
    public $category;


    //Constructor requiring db 
    public function __construct($db){
        $this->conn = $db;
    }

    //Gets all categories 
    public function read(){

        $query = 'SELECT 
                    id,
                    category 
                    FROM 
                    ' . $this->table . 
                    ' ORDER BY 
                    id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt; 
    }

    //Gets one category using given id 
    public function read_single(){
        
            $query = 'SELECT id, category FROM '. $this->table . ' WHERE id = :id LIMIT 0|1';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$row){
                echo json_encode(array('message' => 'category_id Not Found'));
            exit();
            }
        
        
        $this->category = $row['category'];

    }

    //Creates a category using given category 
    public function create(){

        $query = 'INSERT INTO ' . $this->table . ' (category) VALUES (:category)';

        $stmt = $this->conn->prepare($query);

        $this->category = htmlspecialchars(strip_tags($this->category));

        $stmt->bindParam(':category',  $this->category);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function create_find_id(){
        $query = 'SELECT MAX(id) FROM ' . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['max'];

    }

    //Updates a category using given category that has a given id
    public function update(){

        $query = 'UPDATE ' . $this->table . ' SET category = (:category) WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':category',  $this->category);
        $stmt->bindParam(':id',  $this->id);

        if($stmt->execute()){
            return true;
        }

        if(!$this->category){
            echo json_encode(array('Message' => 'Missing Required Parameters'));
        }

        return false;

    }

    //Deletes the category with a given id
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',  $this->id);

        if($stmt->execute()){
            return true;
        }

        if(!$this->id){
            echo json_encode(array('Message' => 'Missing Required id'));
        }

        return false;

    }

}