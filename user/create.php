<?php

include_once "../config/DbCredentialsReader.php";
include_once "../config/Database.php";
include_once "../models/User.php";
include_once "../models/SignupFormValidator.php";

$msg;
$data = json_decode(file_get_contents("php://input"));

$formHasAllData = isset($data->forename) && isset($data->surname) && isset($data->email) && isset($data->password) && isset($data->confirmPass);

if($formHasAllData) {

    $dbCredentialsFile = "../config/db.json";
    $dbCredentialsReader = new DbCredentialsReader();
    $dbCredentials = $dbCredentialsReader->getDbCredentials($dbCredentialsFile);

    $database = new Database($dbCredentials);
    $dbConn = $database->connect();

    $sfv = new SignupFormValidator();

    $forename = $data->forename;
    $surname = $data->surname;
    $email = $data->email;
    $password = $data->password;
    $confirmPassword = $data->confirmPass;

    $formIsValid = $sfv->validateForm($forename, $surname, $email, $password, $confirmPassword);
    $emailRegistered = $sfv->validateEmailExistence($email, $dbConn);

    if($formIsValid && !$emailRegistered) {

        $user = new User($forename, $surname, $email, $password);
        $user->create($dbConn);

        $msg = "success";
    }
    

    if(!$formIsValid) {
        $msg = "fail";
    }

    if($emailRegistered) {
        $msg = "exists";
    }
}
else {
    $msg = "empty";
}

echo json_encode(["msg" => $msg]);

?>