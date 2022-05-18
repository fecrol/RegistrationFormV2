<?php

include "./DataSanitizer.php";

class User implements DataSanitizer {

    private $forename;
    private $surname;
    private $email;
    private $password;

    public function create($dbConn) {

        $query = "INSERT INTO users (forename, surname, email, password, signupDate) VALUES (?, ?, ?, SHA2(?, 256), NOW())";
        $stmt = $dbConn->prepare($query);

        sanitizeData();

        $stmt->bind_param($this->forename, $this->surname, $this->email, $this->password);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function sanitizeData() {
        /*
        Cleans the data to prevent XSS attacks.
        */

        $this->forename = htmlspecialchars(strip_tags($this->forename));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
    }
    
    public function getForename() {

        return $this->forename;
    }

    public function getSurname() {

        return $this->surname;
    }

    public function getEmail() {

        return $this->email;
    }

    public function getPassword() {

        return $this->password;
    }

    public function setForename($forename) {

        $this->forename = $forename;
    }

    public function setSurname($surname) {

        $this->surname = $surname;
    }
    
    public function setEmail($email) {

        $this->email = $email;
    }
    
    public function setPassword($password) {

        $this->password = $password;
    }
}

?>