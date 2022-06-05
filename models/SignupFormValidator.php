<?php

require("StringValidator.php");
require("EmailValidator.php");
require("PasswordValidator.php");

class SignupFormValidator implements StringValidator, EmailValidator, PasswordValidator {

    public function validateForm($forename, $surname, $email, $password, $confirmPassword) {
        /*
        Validates all the passed form data to determine if form is valid for POST request.
        */

        $validForename = $this->validateString($forename);
        $validSurname = $this->validateString($surname);
        $validEmail = $this->validateEmail($email);
        $validPassword = $this->validatePassword($password, $confirmPassword);

        return $validForename && $validSurname && $validEmail && $validPassword;
    }
    
    public function validateString($string) {
        /*
        Checks that the string contains only letters to prevent special characters and numbers in forename and surname.
        */

        $pattern = "/[^a-z']/i";
        return preg_match($pattern, $string) ? false : true;
    }
    
    public function validateEmail($email) {

        $pattern = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        return preg_match($pattern, $email);
    }

    public function validatePassword($password, $confirmPassword) {

        $validLength = $this->validatePasswordLength($password);
        $hasUpper = $this->passwordHasUpper($password);
        $hasNum = $this->passwordHasNum($password);
        $hasApprovedSpecial = $this->passwordHasApprovedSpecial($password);
        $hasIllegalSpecial = $this->passwordHasIllegalSpecial($password);
        $passwordMatch = $this->passwordsMatch($password, $confirmPassword);

        if($validLength && $hasUpper && $hasNum && $hasApprovedSpecial && !$hasIllegalSpecial && $passwordMatch) {
            return true;
        }

        return false;
    }

    public function validatePasswordLength($password) {
        /*
        Checks that the password is at least 6 characters long to improve security.
        */

        return strlen($password) >= 6;
    }

    public function passwordHasUpper($password) {
        /*
        Checks that the password contains at least one uppercase character to improve security.
        */

        $pattern = "/[A-Z]+/";
        return preg_match($pattern, $password) ? true : false;
    }

    public function passwordHasNum($password) {
        /*
        Checks that the password contains at least one numeric character to improve security.
        */

        $pattern = "/\d+/";
        return preg_match($pattern, $password) ? true : false;
    }
    
    public function passwordHasApprovedSpecial($password) {

        $pattern = "/[!@#~$%^&.-]+/";
        return preg_match($pattern, $password) ? true : false;
    }

    public function passwordHasIllegalSpecial($password) {
        /*
        Checks if password contains any not approved special characters to prevent their input.
        */

        $pattern = "/[^0-9a-zA-Z!@#~$%^&.-]+/";
        return preg_match($pattern, $password) ? true : false;
    }

    public function passwordsMatch($password, $confirmPassword) {
        /*
        Checks that the password and confirm password match.
        */

        return $confirmPassword == $password;
    }
}

?>