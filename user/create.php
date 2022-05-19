<?php

include_once "../config/DbCredentialsReader.php";
include_once "../config/Database.php";
include_once "../models/User.php";
include_once "../models/SignupFormValidator.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(!empty($_POST["forename"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-pass"])) {

        $sfv = new SignupFormValidator();

        $forename = $_POST["forename"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-pass"];

        $formIsValid = $sfv->validateForm($forename, $surname, $email, $password, $confirmPassword);

        if($formIsValid) {

            $dbCredentialsFile = "../config/db.json";
            $dbCredentialsReader = new DbCredentialsReader();
            $dbCredentials = $dbCredentialsReader->getDbCredentials($dbCredentialsFile);

            $database = new Database($dbCredentials);
            $dbConn = $database->connect();

            $user = new User($forename, $surname, $email, $password);
            $user->create($dbConn);

            echo json_encode(["msg" => "success"]);
        }
        else {
            echo json_encode(["msg" => "form contains invalid data!"]);
        }
    }
    else {
        echo json_encode(["msg" => "form contains empty field(s)!"]);
    }
}

?>