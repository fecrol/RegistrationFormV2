<?php

include_once "../models/SignupFormValidator.php";

$sfv = new SignupFormValidator();

$msg;
$data = json_decode(file_get_contents("php://input"));

if(isset($data->string)) {

    $string = $data->string;

    $stringIsValid = $sfv->validateString($string);

    if($stringIsValid && strlen($string) > 0) {
        $msg = true;
    }
    else {
        $msg = false;
    }
}
else {
    $msg = "no data to be processed.";
}

echo json_encode(["msg" => $msg]);

?>