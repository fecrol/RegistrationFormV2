<?php

require_once "./DbCredentialsReader.php";

$filePath = "./db.json";

$dbCredentialsReader = new DbCredentialsReader();
$dbCredentials = $dbCredentialsReader->getDbCredentials($filePath);

echo json_encode($dbCredentials);

?>