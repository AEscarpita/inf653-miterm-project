<?php

class Quote {


    private $conn;
    private $table = 'quotes';

    //Quote Properties
    public $id;
    public $category;
    public $author_id;
    public $category_id;


    //Constructor requiring db 
    public function __construct($db){
        $this->conn = $db;
    }

    //Gets all quotes
    public function read(){

        $query = 'SELECT 
                    quotes.id,
                    quotes.quote,
                    authors.author,
                    categories.category 
                    FROM 
                    ' . $this->table . 
                    ' INNER JOIN 
                    authors ON quotes.author_id = authors.id 
                    INNER JOIN categories ON quotes.category_id = categories.id 
                    ORDER BY quotes.id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt; 
    }

    //Get one quote using a given id
    public function read_single(){

            $query = 'SELECT 
            quotes.id,
            quotes.quote,
            authors.author,
            categories.category 
            FROM 
            ' . $this->table . 
            ' INNER JOIN 
            authors ON quotes.author_id = authors.id 
            INNER JOIN categories ON quotes.category_id = categories.id 
            WHERE quotes.id = :id LIMIT 0|1';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$row){
                echo json_encode(array('message' => 'No Quotes Found'));
            exit();
            }

        
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];



    }

    //Gets multiple quotes using a given author_id and category_id 
    public function read_group(){
        $query = 'SELECT 
            quotes.id,
            quotes.quote,
            authors.author,
            categories.category 
            FROM 
            ' . $this->table . 
            ' INNER JOIN 
            authors ON quotes.author_id = authors.id 
            INNER JOIN categories ON quotes.category_id = categories.id 
            WHERE quotes.author_id = :author_id AND quotes.category_id = :category_id';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

            $stmt->execute();

            return $stmt; 
    }
    
    //Gets multiple quotes using a given author_id
    public function read_group_author(){
        $query = 'SELECT 
            quotes.id,
            quotes.quote,
            authors.author,
            categories.category 
            FROM 
            ' . $this->table . 
            ' INNER JOIN 
            authors ON quotes.author_id = authors.id 
            INNER JOIN categories ON quotes.category_id = categories.id 
            WHERE quotes.author_id = :author_id';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':author_id', $this->author_id);

            $stmt->execute();

            return $stmt; 
    }

    //Gets multiple quotes using a given  categoru_id
    public function read_group_category(){
        $query = 'SELECT 
            quotes.id,
            quotes.quote,
            authors.author,
            categories.category 
            FROM 
            ' . $this->table . 
            ' INNER JOIN 
            authors ON quotes.author_id = authors.id 
            INNER JOIN categories ON quotes.category_id = categories.id 
            WHERE quotes.category_id = :category_id';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':category_id', $this->category_id);

            $stmt->execute();

            return $stmt; 
    }

    //Creates a new qoute using given quote, author_id, and category_id
    public function create(){
        
        $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)';

        $stmt = $this->conn->prepare($query);
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(':quote',  $this->quote);
        $stmt->bindParam(':author_id',  $this->author_id);
        $stmt->bindParam(':category_id',  $this->category_id);

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

    //Updates an existing qoute using given quote, author_id, category_id selected using given id
    public function update(){

        $query = 'UPDATE ' . $this->table . ' SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':quote',  $this->quote);
        $stmt->bindParam(':author_id',  $this->author_id);
        $stmt->bindParam(':category_id',  $this->category_id);
        $stmt->bindParam(':id',  $this->id);

        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //checks that the id actually changes a qoute 
        if($result === []){
            return true;
        }

        return false;

    
    }

    //Deletes quote with given id 
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',  $this->id);

        $stmt->execute();
            
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //checks that the id acutally causes a qoute to be deleted 
        if($result === []){
            return true;
        }

        return false;

        

    }
        

}