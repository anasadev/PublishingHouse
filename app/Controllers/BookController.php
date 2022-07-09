<?php

namespace App\Controllers;

use App\Models\Book;

class BookController extends Controller {

    public function index()
    {
        $book = new Book($this->getDB());
        $books = $book->all();
        
        return $this->view('booksIndex', compact('books'));
    }

    public function show(int $id)
    {
        $book = new Book($this->getDB());
        $book->setId($id);
        $book->findBookById();
        $book->findBookAuthors();
        
        return $this->view('booksShow', compact('book'));
    }
}