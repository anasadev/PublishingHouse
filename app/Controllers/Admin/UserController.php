<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller {
    
    public function login()
    {
        return $this->view('admin.login');
    }
    
    public function dashboard()
    {
        $this->isAdmin();
        return $this->view('admin.dashboard');
    }
    
    public function loginPost()
    {
        $_SESSION['errors'] = [];
        
        $fields = ['email', 'password'];
        $dataPost = [$_POST['email'], $_POST['password']];
   
        if (isset($_POST)){
            
            if (in_array('', $_POST)) {
                $_SESSION['errors'][] = 'Impossible de soumettre le formulaire, au moins un des champs est vide';
            } else {
                $validator = new Validator($_POST, $fields);
                $validated = $validator->verifyArrayKeyExists();
                
                if (!$validated) {
                    $_SESSION['errors'][] = "Une erreur est survenue";
                } else {

                    $validator->validateData();
                    
                    $validatedData = $validator->getData();
                    
                    $email = $validatedData[0];
                    $password = $validatedData[1];
                    
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['errors'][] = "Format d'email invalide";
                    } else {
                        $user = new User($this->getDB());
                        $user->setEmail($email);
                        $userExists = $user->getByMail();
                        
                        if (!$userExists) {
                            $_SESSION['errors'][] = "Erreur d'identification";
                        } else {
                            
                            if (password_verify($password, $user->getPassword())) {
                                if ($user->getIsAdmin()) {
                                    $_SESSION['connected'] = true;
                                    $_SESSION['auth'] = $user->getIsAdmin();
                                    return header('Location: /Projet/admin/dashboard');
                                } else {
                                    $_SESSION['errors'][] = "Erreur d'identification";
                                }
                            } else {
                                $_SESSION['errors'][] = "Erreur d'identification";
                            }
                        }
                    } 
                }
            }
        }
        if(isset($_SESSION['errors'])){
            return $this->view('admin.login'); 
        }
    }
    
    public function logout()
    {
        $_SESSION['connected'] = false;
        session_destroy();
        return header('Location: /Projet/admin/login');
    }
    
}