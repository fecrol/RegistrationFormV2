<?php

require("StringValidator.php");
require("EmailValidator.php");
require("PasswordValidator.php");

class SignupFormValidator implements StringValidator, EmailValidator, PasswordValidator {

    public function validateString($string) {

        $pattern = "/[^a-z]/i";
        return preg_match($pattern, $string);
    }
    
    public function validateEmail($email) {

    }

    public function validatePassword($password) {

    }

    public function validatePasswordLength($password) {

    }

    public function validatePasswordHasUpper($password) {

    }

    public function validatePasswordHasNum($password) {

    }
    
    public function validatePasswordHasSpecial($password) {

    }

    public function validatePasswordsMatch($password, $confirmPassword) {

    }
}

$s = new SignupFormValidator();
$r = $s->validateString("Maciej");

?>