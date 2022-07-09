<?php

namespace App\Models;

use \PDO;
use Database\DBConnection;

abstract class Model {
  
    protected $db;
    protected $table;
    protected $id;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function all(): array
    {
        $stmt = $this->db->getPDO()->query("
            SELECT * 
            FROM {$this->table} 
            ORDER BY created_at 
            DESC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->fetchAll();
    }
    
    public function delete(): bool
    {
        $stmt = $this->db->getPDO()->prepare("
            DELETE 
            FROM {$this->table} 
            WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->execute([$this->id]);
    }
}






















