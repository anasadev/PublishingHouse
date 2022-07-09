<?php

namespace App\Models;

use \PDO;

class Author extends Model {
  
    protected $table = 'author';
    private string $first_name; 
    private string $last_name;
    private string $bio;
    private string $created_at;
    private string $photo;
    private string $alt_image;
    private array $books = [];
  
    
  // GET METHODS

    public function getFirstName(){
        return $this->first_name;
    }
    
    public function getLastName(){
        return $this->last_name;
    }
    
    public function getBio(){
        return $this->bio;
    }
    
    public function getCreatedAt(){
        return $this->created_at;
    }
    
    public function getPhoto(){
        return $this->photo;
    }
    
    public function getAltImage(){
        return $this->alt_image;
    }
    
    public function getBooks(){
        return $this->books;
    }
    
    // SET METHODS
    public function setId(int $id){
        $this->id = $id;
    }
    
    public function setFirstName(string $first_name){
        $this->first_name = $first_name;
    }
    
    public function setLastName(string $last_name){
        $this->last_name = $last_name;
    }   
    
    public function setBio(string $bio){
        $this->bio = $bio;
    }
    
    public function setPhoto(string $photo){
        $this->photo = $photo;
    }
    
    public function setAltImage(string $alt_image){
        $this->alt_image = $alt_image;
    }
    
    public function setCreatedAt(string $created_at){
        $this->created_at = $created_at;
    }
    
    public function setBooks($books){
        $this->books = $books;
    }
    

//OTHER FUNCTIONS
    public function getButton(): string
    {
        return <<<HTML
    <a href="/Projet/authors/$this->id">Sur l'auteur</a>
HTML;
    }

    public function findAuthorById()
    { 
        $stmt = $this->db->getPDO()->prepare("
            SELECT id, first_name, last_name, bio, created_at, photo, alt_image 
            FROM author 
            WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $row = $stmt->fetch();
     
        if(!$row){
            return false;
        }
        
        $this->id = $row['id'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->bio = $row['bio'];
        $this->created_at = $row['created_at'];
        $this->photo = $row['photo'];
        $this->alt_image = $row['alt_image'];
        
        return true;      
    }
  
    public function findAuthorsBooks()
    {
        $stmt = $this->db->getPDO()->prepare("
            SELECT book.id, book.title, book.image, book.alt_image 
            FROM author 
            INNER JOIN author_book 
            ON author.id = author_book.fk_author_id 
            INNER JOIN book 
            ON book.id = author_book.fk_book_id 
            WHERE author.id = :id");
            
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    
        foreach($rows as $row){
            $book = new Book($this->db);
            $book->setId($row['id']);
            $book->setTitle($row['title']);
            $book->setImage($row['image']);
            $book->setAltImage($row['alt_image']);
            array_push($this->books, $book);
        }
       return $this->books;
  }
}