<?php

class Database {

    private $host;
    private $dbName;
    private $username;
    private $password;
    private $conn;

    public function __construct($dbCredentials) {

        $this->host = $dbCredentials["host"];
        $this->dbName = $dbCredentials["db_name"];
        $this->username = $dbCredentials["username"];
        $this->password = $dbCredentials["password"];
    }

    public function connect() {
        /*
        Establishes a connection with the database for queries.
        */

        $this->conn = null;

        try {
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbName);
        }
        catch(Exception $e) {
            die("Could not connect to databse: " . mysqli_error());
        }

        return $this->conn;
    }
}

?>