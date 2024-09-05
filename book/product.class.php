<?php 

require_once 'database.php';

class Book{
    public $id = '';
     public $bookTitle = '';
     public $bookAuthor = '';
     public $bookGenre = '';
     public $bookPublisher = '';
     public $bookPublishDate = '';
     public $bookEdition ='';
     public $bookCopies ='';
     public $bookFormat ='';
     public $ageGroup ='';
     public $bookRating ='';

     private $query = '';

     protected $db;

     function __construct() {
        $this->db = new Database();
     }

    
    function add() {
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
    }

    function showAll(){
        $sql = "Select * from book order by bookTitle ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;

        if($query->execute()) {
            $data = $query->fetchAll();
        }

        return $data;
    }

    function edit(){
         $sql = "Update book set bookTitle = :bookTitle, bookAuthor = :bookAuthor, bookGenre = :bookGenre, bookPublisher = :bookPublisher, bookPublishDate = :bookPublishDate, bookEdition = :bookEdition,
                bookCopies = :bookCopies, bookFormat = :bookFormat, ageGroup = :ageGroup, bookRating = :bookRating WHERE bookId = :bookId;";

         $query = $this->db->connect()->prepare($sql); 
         
         $query->bindParam(":bookId", $this->id);
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

         return $query->execute();

    }

    function fetchRecord($recordID){
        $sql = "Select * From book where bookId = :recordID;";

        $query = $this->db->connect()->prepare($sql); 

         $query->bindParam(":recordID", $recordID);
         $data = null;

         if($query->execute()) {
            $data = $query->fetch();
        }

        return $data;
    }
}