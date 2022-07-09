<?php

namespace App\Controllers;

use App\Models\Author;

class AuthorController extends Controller {

    public function index()
    {
        $author = new Author($this->getDB());
        $authors = $author->all();
        
        return $this->view('authorsIndex', compact('authors'));
    }

    public function show(int $id)
    {
        $author = new Author($this->getDB());
        $author->setId($id);
        $author->findAuthorById();
        $author->findAuthorsBooks();
    
        return $this->view('authorsShow', compact('author'));
    }
}