<?php

class DbCredentialsReader {

    private $dbCredentails;

    public function __construct() {

        $this->dbCredentials = null;
    }

    public function getDbCredentials($filePath) {
        /*
        Reads in database credentials from db.json to use for database connection.
        */

        if(file_exists($filePath)) {

            $file = file_get_contents($filePath);
            $this->dbCredentials = json_decode($file, true);

            return $this->dbCredentials;
        }

        return $this->dbCredentials;
    }
}

?>