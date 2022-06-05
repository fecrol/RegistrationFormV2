<?php

include_once "../config/DbCredentialsReader.php";
include_once "../config/Database.php";
include_once "../models/User.php";
include_once "../models/SignupFormValidator.php";

$msg;
$data = json_decode(file_get_contents("php://input"));

$formHasAllData = isset($data->forename) && isset($data->surname) && isset($data->email) && isset($data->password) && isset($data->confirmPass);

if($formHasAllData) {

    $sfv = new SignupFormValidator();

    $forename = $data->forename;
    $surname = $data->surname;
    $email = $data->email;
    $password = $data->password;
    $confirmPassword = $data->confirmPass;

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
        echo json_encode(["msg" => "fail"]);
    }
}
else {
    echo json_encode(["msg" => "form contains empty field(s)!"]);
}


?>