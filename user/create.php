<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once "../config/DbCredentialsReader.php";
    include_once "../config/Database.php";
    include_once "../models/User.php";

    $dbCredentialsFile = "../config/db.json";
    $dbCredentialsReader = new DbCredentialsReader();
    $dbCredentials = $dbCredentialsReader->getDbCredentials($dbCredentialsFile);

    $database = new Database($dbCredentials);
    $dbConn = $database->connect();

    $forename = $_POST["forename"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = new User($forename, $surname, $email, $password);
}

?>