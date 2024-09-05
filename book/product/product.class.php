<?php 

require_once 'database.php';

class Product{
    public $id = '';
    public $name = '';
    public $category = '';
    public $price = '';
    public $availability = '';

     private $query = '';

     protected $db;

     function __construct() {
        $this->db = new Database();
     }

    
    /*function add() {
        $sql = 'INSERT INTO book (bookTitle, bookAuthor, bookGenre, bookPublisher, bookPublishDate, bookEdition, bookCopies, bookFormat, ageGroup, bookRating) VALUES (
        :bookTitle, :bookAuthor, :bookGenre, :bookPublisher, :bookPublishDate, :bookEdition, :bookCopies, :bookFormat, :ageGroup, :bookRating);';

        $query = $this->db->connect()->prepare($sql);
        
        $query->bindParam(":bookTitle", $this->bookTitle);
        $query->bindParam(":bookAuthor", $this->bookAuthor);
        $query->bindParam(":bookGenre", $this->bookGenre);
        $query->bindParam(":bookPublisher", $this->bookPublisher);
        $query->bindParam(":bookPublishDate", $this->bookPublishDate);
        $query->bindParam(":bookEdition", $this->bookEdition);
        $query->bindParam(":bookCopies", $this->bookCopies);
        $query->bindParam(":bookFormat", $this->bookFormat);
        $query->bindParam(":ageGroup", $this->ageGroup);
        $query->bindParam(":bookRating", $this->bookRating);

        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }*/

    function showAll(){
        $sql = "Select * from product order by name ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;

        if($query->execute()) {
            $data = $query->fetchAll();
        }

        return $data;
    }

    function edit(){
         $sql = "Update product set name = :name, category = :category, price = :price, availability = :availability where id = :id;";
         $query = $this->db->connect()->prepare($sql); 
         
         $query->bindParam(":id", $this->id);
         $query->bindParam(":name", $this->name);
         $query->bindParam(":category", $this->category);
         $query->bindParam(":price", $this->price);
         $query->bindParam(":availability", $this->availability);

         return $query->execute();

    }

    function fetchRecord($recordID){
        $sql = "Select * From product where id = :recordID;";

        $query = $this->db->connect()->prepare($sql); 

         $query->bindParam(":recordID", $recordID);
         $data = null;

         if($query->execute()) {
            $data = $query->fetch();
        }

        return $data;
    }

}