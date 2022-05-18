<?php

interface PasswordValidator {

    public function validatePassword($password, $confirmPassword);
    
    public function validatePasswordLength($password);
    
    public function passwordHasUpper($password);
    
    public function passwordHasNum($password);
    
    public function passwordHasApprovedSpecial($password);

    public function passwordHasIllegalSpecial($password);

    public function passwordsMatch($password, $confirmPassword);
}

?>