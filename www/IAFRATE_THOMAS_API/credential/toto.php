<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/IAFRATE_THOMAS_API/credentials/mdp.php");
$cred = credential\mdp::GetCredentials("credentials.json");
echo $cred->username . "<br>" . $cred->password;

$dbh = new PDO("mysql:host=localhost;dbname=iafrate_thomas_api", $cred->username, $cred->password);

var_dump($dbh);