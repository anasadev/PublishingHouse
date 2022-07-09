<?php

namespace App\Models;

use \PDO;

class Book extends Model {
  
    protected $table = 'book';
    private string $title;
    private string $created_at;
    private string $binding;
    private string $description;
    private int $price;
    private int $stock;
    private string $format;
    private int $pages;
    private string $isbn;
    private string $image;
    private string $alt_image;
    private array $authors = [];

  // GET METHODS
  
    public function getTitle(){
        return $this->title;
    }
    
    public function getCreatedAt(){
        return $this->created_at;
    }
    
    public function getBinding(){
        return $this->binding;
    }
    
    public function getDescription(){
        return $this->description;
    } 
    
    public function getPrice(){
        return $this->price;
    }
    
    public function getStock(){
        return $this->stock;
    }
    
    public function getFormat(){
        return $this->format;
    }
    
    public function getPages(){
        return $this->pages;
    } 
    
    public function getIsbn(){
        return $this->isbn;
    }
    
    public function getImage(){
        return $this->image;
    }
    
    public function getAltImage(){
        return $this->alt_image;
    }
    
    public function getAuthors(){
        return $this->authors;
    }
    
    // SET METHODS
    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    public function setTitle(string $title)
    {
        $this->title = $title;;
    }
    
    public function setDescription(string $description)
    {
        $this->description = $description;
    } 
    
    public function setBinding(string $binding)
    {
        $this->binding = $binding;
    }
    public function setPrice(int $price)
    {
        $this->price = $price;
    }
    
    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }
    
    public function setFormat(string $format)
    {
        $this->format = $format;
    }
    
    public function setPages(int $pages)
    {
        $this->pages = $pages;
    } 
    
    public function setIsbn(string $isbn)
    {
        $this->isbn = $isbn;
    }
    
    public function setImage(string $image)
    {
        $this->image = $image;
    }
    
    public function setAltImage(string $alt_image)
    {
        $this->alt_image = $alt_image;
    }  
    
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }
    
    public function setBooks($books)
    {
        $this->books = $books;
    }
    
    
  //OTHER FUNCTIONS
    public function findBookById()
    {  
        $stmt = $this->db->getPDO()->prepare("
            SELECT id, title, created_at, binding, description, price, format, pages, isbn, image, alt_image 
            FROM book 
            WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $row = $stmt->fetch();
          
        if(!$row){
            return false;
        }
        
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->created_at = $row['created_at'];
        $this->binding = $row['binding'];
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->format = $row['format'];
        $this->pages = $row['pages'];
        $this->isbn = $row['isbn'];
        $this->image = $row['image'];
        $this->alt_image = $row['alt_image'];
        
        return true;
  }
    
    public function findBookAuthors(): array
    {  
        $stmt = $this->db->getPDO()->prepare("
            SELECT author.id, author.first_name, author.last_name 
            FROM author 
            INNER JOIN author_book 
            ON author.id = author_book.fk_author_id 
            INNER JOIN book 
            ON book.id = author_book.fk_book_id 
            WHERE book.id = :id");
        
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
        foreach($rows as $row){
            $author = new Author($this->db);
            $author->setId($row['id']);
            $author->setFirstName($row['first_name']);
            $author->setLastName($row['last_name']);
            array_push($this->authors, $author);
        }
        return $this->authors;
    }
  
    public function getExcerpt(): string
    {
        return substr($this->getDescription(), 0, 200) . '...';
    }
  
     public function formatCreatedAt(): string
    {
        return (new \DateTime($this->getCreatedAt()))->format('Y');
    }
}