<?php

namespace App\Models;
use \PDO;

class User extends Model {
  
    protected $table = 'user';
    
    private string $email;
    private string $password;
    private bool $isAdmin;
    private string $created_at;
    
    // GET METHODS

    public function getEmail(){
        return $this->email;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function getCreatedAt(){
        return $this->created_at;
    }
    
    public function getIsAdmin(){
        return $this->isAdmin;
    }
    
    // SET METHODS
    public function setEmail(string $email){
        $this->email = $email;
    }
    
    public function setPassword(string $password){
        $this->password = $password;
    }

    //OTHER FUNCTIONS
    
    public function getByMail()
    {
        $q = $this->db->getPDO()->prepare('
            SELECT id, email, password, created_at, isAdmin 
            FROM user 
            WHERE email = :email');
        $q->bindValue(':email', $this->email, PDO::PARAM_STR);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $q->execute();
        $row = $q->fetch();
        
        if(!$row){
            return false;
        }
        
        $this->email = $row['email'];
        $this->id = $row['id'];
        $this->password = $row['password'];
        $this->created_at = $row['created_at'];
        $this->isAdmin = $row['isAdmin'];
        
        return true;
    }
}