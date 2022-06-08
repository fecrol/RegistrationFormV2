<?php

interface EmailValidator {

    public function validateEmail($email);

    public function validateEmailExistence($email, $dbConn);
}

?>