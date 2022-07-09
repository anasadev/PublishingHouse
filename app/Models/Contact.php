<?php

namespace App\Models;
use \PDO;

class Contact extends Model {
  
    protected $table = 'message'; 
    private string $name;
    private string $email;
    private string $question;
    private string $message_content;
    private string $created_at;

   // GET METHODS

    public function getName(){
        return $this->name;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getQuestion(){
        return $this->question;
    }
    
    public function getMessageContent(){
        return $this->message_content;
    }
    
    public function getCreatedAt(){
        return $this->created_at;
    }
    
    //SET METHODS
    public function setName(string $name){
        $this->name = $name;
    }
    
    public function setEmail(string $email){
        $this->email = $email;
    }
    
    public function setQuestion(string $question){
        $this->question = $question;
    }
    
    public function setMessageContent(string $message_content){
        $this->message_content = $message_content;
    }
    
    //CRUD OPERATIONS
    
    public function insert()
    {
        $q = $this->db->getPDO()->prepare('
            INSERT INTO message(name, email, question, message_content, created_at) 
            VALUES (:name , :email , :question, :message_content , NOW())');
        
        $q->bindValue(':name', $this->name, PDO::PARAM_STR);
        $q->bindValue(':email', $this->email, PDO::PARAM_STR);
        $q->bindValue(':question', $this->question, PDO::PARAM_STR);
        $q->bindValue(':message_content', $this->message_content, PDO::PARAM_STR);
            
        return $q->execute();
    }
}