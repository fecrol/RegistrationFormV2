<?php

include_once "../models/SignupFormValidator.php";

$sfv = new SignupFormValidator();

$msg;
$data = json_decode(file_get_contents("php://input"));

if(isset($data->pass) && isset($data->confirmPass)) {

    $pass = $data->pass;
    $confirmPass = $data->confirmPass;

    $passwordsMatch = $sfv->passwordsMatch($pass, $confirmPass);

    if($passwordsMatch) {
        $msg = true;
    }
    else {
        $msg = false;
    }
}
else {
    $msg = "no data to be processed";
}

echo json_encode(["msg" => $msg]);

?>