<?php

interface EmailValidator {

    public function validateEmail($email);

    public function validateEmailExistance($email, $dbConn);
}

?>