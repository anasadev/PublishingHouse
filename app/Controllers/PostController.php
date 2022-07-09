<?php

namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller {

    public function index()
    {
        $post = new Post($this->getDB());
        $posts = $post->lastPosts();
        
        return $this->view('index', compact('posts'));
    }

}