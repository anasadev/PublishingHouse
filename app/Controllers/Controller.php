<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller {

    protected $db;
    
    public function __construct(DBConnection $db)
    {
        $this->db = $db;
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.phtml';
        $content = ob_get_clean();
        require VIEWS . 'layout.phtml';
    }
    
    protected function getDB()
    {
        return $this->db;
    }
    
    protected function isAdmin()
    {
        if(isset($_SESSION['connected']) && $_SESSION['auth'] == 1){
            return true;
        } else {
            return header('Location: /Projet/admin/login');
        }
    }
}









