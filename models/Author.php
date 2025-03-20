<?php

class Author {


    private $conn;
    private $table = 'authors';

    //Author Properties
    public $id;
    public $author;


    //Constructor requiring db 

    public function __construct($db){
        $this->conn = $db;
    }

    //Gets all authors 
    public function read(){

        $query = 'SELECT 
                    id,
                    author 
                    FROM 
                    ' . $this->table . 
                    ' ORDER BY 
                    id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt; 
    }

    //Gets an author with given id
    public function read_single(){

            $query = 'SELECT id, author FROM '. $this->table . ' WHERE id = :id LIMIT 0|1';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$row){
                echo json_encode(array('message' => 'author_id Not Found'));
            exit();
            }

           
        
        
        
        $this->author = $row['author'];

    }

    //Creates a author using given author value 
    public function create(){

        $query = 'INSERT INTO ' . $this->table . ' (author) VALUES (:author)';

        $stmt = $this->conn->prepare($query);

        $this->author = htmlspecialchars(strip_tags($this->author));

        $stmt->bindParam(':author',  $this->author);

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

    ////Updates an author using given author value that has a given id
    public function update(){

        $query = 'UPDATE ' . $this->table . ' SET author = (:author) WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':author',  $this->author);
        $stmt->bindParam(':id',  $this->id);

        if($stmt->execute()){
            return true;
        }

        if(!$this->author){
            echo json_encode(array('Message' => 'Missing Required Parameters'));
        }

        return false;

    }

    //Deletes author with given id value
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
