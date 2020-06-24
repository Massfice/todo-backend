<?php

namespace App\Authentication;

use Exception;

class AuthException extends Exception {
    private $errors;

    /**
     * Constructor to set error array
     * 
     * @return void
     * @param array
     */  
    public function __construct(array $errors) {
        $this->errors = $errors;
    }

    /**
     * Function toget errors
     * 
     * @return array
     * 
     */      
    public function getErrors() : array {
        return $this->errors;
    }
}