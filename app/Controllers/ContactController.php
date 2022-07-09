<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Validation\Validator;

class ContactController extends Controller {

    public function show()
    {
        return $this->view('contact');
    }
    
    public function send()
    {
        $_SESSION['errors'] = [];
        $_SESSION['success'] = [];
        $fields = ['name', 'email', 'question', 'message_content'];
        $dataPost = [$_POST['name'], $_POST['email'], $_POST['question'], $_POST['message_content']];
        
        if(isset($_POST)){
            if (in_array('', $_POST)) {
                $_SESSION['errors'][] = "Impossible de soumettre le formulaire, au moins un des champs est vide";
            } else {
                $validator = new Validator($_POST, $fields);
                $validated = $validator->verifyArrayKeyExists();
                if(!$validated) {
                    $_SESSION['errors'][] ="Une erreur est survenue";
                } else {
                    $validator->validateData();
                    $validatedData = $validator->getData();
                    
                    $name = $validatedData[0];
                    $email = $validatedData[1];
                    $question = $validatedData[2];
                    $message_content = $validatedData[3];
                    
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $_SESSION['errors'][] = "Format d'email invalide"; 
                    } elseif(!preg_match("/^[-a-z\s?]+$/i", $name)){
                        $_SESSION['errors'][] = "Votre nom doit contenir au moins deux caractères. Caractères autorisés : lettres, espaces et tiret.";
                    } elseif(strlen($message_content) > 1200){
                        $_SESSION['errors'][] = "Votre message doit contenir 1200 caractères maximum.";   
                    } else {
                        $contact = new Contact($this->getDB());
                        $contact->setName($name);
                        $contact->setEmail($email);
                        $contact->setQuestion($question);
                        $contact->setMessageContent($message_content);
                        $contact->insert();
                        $_SESSION['success'][] = "Message envoyé avec succès!";
                        return $this->view('contact');
                    }
                }
            } 
        } 
        if(isset($_SESSION['errors'])){
            return $this->view('contact'); 
        } 
    }
}