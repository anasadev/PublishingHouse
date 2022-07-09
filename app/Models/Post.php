<?php

namespace App\Models;

use \PDO;

class Post extends Model {
  
    protected $table = 'article_blog';
    private string $title;
    private string $image;
    private string $alt_image;
    private string $content;
    private string $created_at;
  
  // GET METHODS
    
    public function getTitle(){
        return $this->title;
    }
    
    public function getImage(){
        return $this->image;
    }
  
    public function getAltImage(){
        return $this->alt_image;
    }
    
    public function getContent(){
        return $this->content;
    }
    
    public function getCreatedAt(){
        return $this->created_at;
    }
  
   // SET METHODS
  
    public function setId(string $id)
    {
        $this->id = $id;
    }
  
    public function setTitle(string $title){
        $this->title = $title;
    }
    
    public function setImage(string $image){
        $this->image = $image;
    }
    
    public function setAltImage(string $alt_image){
        $this->alt_image = $alt_image;
    }

    public function setContent(string $content){
        $this->content = $content;
    }
  
  //CRUD FUNCTIONS
  
    public function insert()
    {
        $q = $this->db->getPDO()->prepare(
            'INSERT INTO article_blog(title, image, alt_image, content, created_at) 
            VALUES (:title , :image , :alt_image , :content , NOW())');
        $q->bindValue(':title', $this->title, PDO::PARAM_STR);
        $q->bindValue(':image', $this->image, PDO::PARAM_STR);
        $q->bindValue(':alt_image', $this->alt_image, PDO::PARAM_STR);
        $q->bindValue(':content', $this->content, PDO::PARAM_STR);
            
        $this->id = $q->execute();
              
    }
    
    public function update()
    {
        $q = $this->db->getPDO()->prepare(
            'UPDATE article_blog 
            SET title = :title, image = :image, alt_image = :alt_image, content = :content WHERE id = :id');
        $q->bindValue(':id', $this->id, PDO::PARAM_INT);
        $q->bindValue(':title', $this->title, PDO::PARAM_STR);
        $q->bindValue(':image', $this->image, PDO::PARAM_STR);
        $q->bindValue(':alt_image', $this->alt_image, PDO::PARAM_STR);
        $q->bindValue(':content', $this->content, PDO::PARAM_STR);
              
        return $q->execute();
    }
    
  //OTHER FUNCTIONS
  
    public function formatCreatedAt(): string
    {
        return (new \DateTime($this->getCreatedAt()))->format('d/m/Y');
    }
  
    public function lastPosts()
    {
        $q = $this->db->getPDO()->query("
            SELECT id, title, image, alt_image, content, created_at 
            FROM article_blog 
            ORDER BY created_at 
            DESC LIMIT 3");
        $q->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $q->fetchAll();
    }
  
    public function findPostById()
    { 
        $q = $this->db->getPDO()->prepare("
            SELECT id, title, image, alt_image, content, created_at 
            FROM article_blog 
            WHERE id = :id");
        $q->bindValue(':id', $this->id, PDO::PARAM_INT);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $q->execute();
        $row = $q->fetch();
        
        if(!$row){
            return false;
        }
        
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->image = $row['image'];
        $this->alt_image = $row['alt_image'];
        $this->content = $row['content'];
        $this->created_at = $row['created_at'];
        
        return true;      
   }
}
  