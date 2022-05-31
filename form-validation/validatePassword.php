<?php

include_once "../models/SignupFormValidator.php";

$sfv = new SignupFormValidator();

$msg;
$data = json_decode(file_get_contents("php://input"));

if(isset($data->password)) {

    $password = $data->password;

    $validPassLength = $sfv->validatePasswordLength($password);
    $passHasUpper = $sfv->passwordHasUpper($password);
    $passHasNum = $sfv->passwordHasNum($password);
    $passHasApprovedSpecial = $sfv->passwordHasApprovedSpecial($password);
    $passHasIllegalSpecial = $sfv->passwordHasIllegalSpecial($password);

    $msg = ["validLength" => $validPassLength, "hasUpper" => $passHasUpper, "hasNum" => $passHasNum, "hasApprovedSpecial" => $passHasApprovedSpecial, "hasIllegalSpecial" => $passHasIllegalSpecial];
}
else {
    $msg = "no data to be processed";
}

echo json_encode(["msg" => $msg]);

?>