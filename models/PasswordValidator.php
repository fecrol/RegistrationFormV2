<?php

interface PasswordValidator {

    public function validatePassword($password);
    
    public function validatePasswordLength($password);
    
    public function validatePasswordHasUpper($password);
    
    public function validatePasswordHasNum($password);
    
    public function validatePasswordHasSpecial($password);

    public function validatePasswordsMatch($password, $confirmPassword);
}

?>