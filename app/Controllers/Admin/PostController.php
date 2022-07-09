<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Validation\Validator;


class PostController extends Controller{
  
    public function index()
    {
        $this->isAdmin();
    
        $post = new Post($this->getDB());
        $posts = $post->all();
        return $this->view('admin.index', compact('posts'));
    }
  
    public function create()
    {
        $this->isAdmin();
        return $this->view('admin.create');
    }
  
    public function createPost(){
    
        $this->isAdmin();
    
        $_SESSION['errors'] = [];
        $_SESSION['success'] = [];
        
        $image = $this->uploadImage($_FILES);
        
        if(empty($_SESSION['errors'])){
            $validatedData = $this->verifyPost($_POST);
            if(empty($_SESSION['errors'])){
                $title = $validatedData[0];
                $alt_image = $validatedData[1];
                $content = $validatedData[2];
                if(strlen($title) > 100) {
                    $_SESSION['errors'][] = "Le titre doit avoir 100 caractères maximum.";
                } elseif(strlen($alt_image) > 255) {
                    $_SESSION['errors'][] = "L'alt de l'image doit avoir 255 caractères maximum.";
                } elseif(strlen($content) > 3000) {
                    $_SESSION['errors'][] = "Le contenu de l'article doit avoir 3000 caractères maximum.";
                } else {
                    $post = new Post($this->getDB());
                    $post->setTitle($title);
                    $post->setImage($image);
                    $post->setAltImage($alt_image);
                    $post->setContent($content);
                    $id = $post->insert();
                } 
            } 
        }
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
            return $this->view('admin.editMessage');
        } else {
            $_SESSION['success'][] = "Votre post a été publié.";
            return $this->view('admin.editMessage');
        }
    } 
    
    public function verifyPost($data)
    {
        $this->isAdmin();
        
        $_SESSION['errors'] = [];
        $fields = ['title', 'alt_image', 'content'];
        $dataPost = [$_POST['title'], $_POST['alt_image'], $_POST['content']];

        if(isset($_POST)) {
            if (in_array('', $_POST)) {
                $_SESSION['errors'][] = "Impossible de soumettre le formulaire, au moins un des champs est vide";
            } else {
                $validator = new Validator($_POST, $fields);
                $validated = $validator->verifyArrayKeyExists();
                if (!$validated) {
                    $_SESSION['errors'][] = "Une erreur est survenue";
                } else {
                    $validator->validateData();
                    $validatedData = $validator->getData();
                    return $validatedData;
                }
            }
        }
    }

    public function uploadImage($image)
    {
        $this->isAdmin();
        $_SESSION['errors'] = [];
        
        if (!isset($_FILES['image']) && $_FILES['image']['error'] !== 0) {
            $_SESSION['errors'] = "Une erreur est survenue pendant l'envoi de l'image";
        } else {
            $allowed = [
                "jpg" => "image/jpeg",
                "jpeg" => "image/jpeg",
                "png" => "image/png",
                ];
                
            $filename = $_FILES['image']['name'];
            $filetype = $_FILES['image']['type'];
            $filesize = $_FILES['image']['size'];
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
                $_SESSION['errors'][] = "Erreur : fichier inexistant ou format de fichier incorrect.";
            } elseif ($filesize > 5 * 1024 * 1024) {
                    $_SESSION['errors'][] = "Erreur : Fichier trop volumineux";
                } else {
                    $newlocation = "/home/homes/analuisacarvalhodesa/sites/Projet/public/assets/$filename";
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $newlocation)) {
                        $_SESSION['errors'][] = "L'upload a échoué";
                    }
                    chmod($newlocation, 0644);
                    $image = $filename;
                }
        }
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
            return false;
        } else {
            return $image;
        }
    }
    
  
    public function edit(int $id)
    {
        $this->isAdmin();
      
        $post = new Post($this->getDB());
        $post->setId($id);
        $postExists = $post->findPostById();
      
        return $this->view('admin.edit', compact('post'));
    }
  
    public function updatePost(int $id)
    {
        $this->isAdmin();
      
        $_SESSION['errors'] = [];
        $_SESSION['success'] = [];
        $image = $this->uploadImage($_FILES);
        if(empty($_SESSION['errors'])){
            $validatedData = $this->verifyPost($_POST);
            if(empty($_SESSION['errors'])){
                $title = $validatedData[0];
                $alt_image = $validatedData[1];
                $content = $validatedData[2];
                if(strlen($title) > 100) {
                    $_SESSION['errors'][] = "Le titre doit avoir 100 caractères maximum.";
                } elseif(strlen($alt_image) > 255) {
                    $_SESSION['errors'][] = "L'alt de l'image doit avoir 255 caractères maximum.";
                } elseif(strlen($content) > 3000) {
                    $_SESSION['errors'][] = "Le contenu de l'article doit avoir 3000 caractères maximum.";
                } else {
                    $post = new Post($this->getDB());
                    $post->setId($id);
                    $post->findPostById();

                    $post->setTitle($title);
                    $post->setImage($image);
                    $post->setAltImage($alt_image);
                    $post->setContent($content);
                    $result = $post->update();
                } 
            } 
        }
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
            return $this->view('admin.editMessage');
        } else {
            $_SESSION['success'][] = "Votre post a été modifié.";
            return $this->view('admin.editMessage');
        }
    }
    
    public function deletePost(int $id)
    {
        $this->isAdmin();
        
        $_SESSION['errors'] = [];
        $_SESSION['success'] = [];
        
        $post = new Post($this->getDB());
        $post->setId($id);
        $postExists = $post->findPostById();
        
        $result = $post->delete();
        
        if($result){ 
            $_SESSION['success'][] = "Le post choisi vient d'être supprimé";
            return $this->view('admin.editMessage');
        } else {
            $_SESSION['errors'][] = "Une erreurs est survenue.";
            return $this->view('admin.editMessage');
        }
    }
} 

