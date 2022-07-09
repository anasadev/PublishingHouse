<?php

namespace App\Validation;

class Validator {
  
    private $data;
    private $fields;
    private $errors = [];
    
    public function __construct(array $dataPost, array $fieldsPost)
    {
        $this->data = $dataPost;
        $this->fields = $fieldsPost;
    }
    
    public function getData(){
        return $this->data;
    }
    
    public function verifyArrayKeyExists()
    {
        $error = true;
        foreach($this->fields as $field){
            if(!array_key_exists($field, $this->data)){
                $error = false;
            }
        }
        return $error;
    }
    
    public function validateData()
    {
        $validatedData = [];
        foreach($this->data as $data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            array_push($validatedData, $data);
        }
        $this->data = $validatedData;
        return $this->data;
    }
}
