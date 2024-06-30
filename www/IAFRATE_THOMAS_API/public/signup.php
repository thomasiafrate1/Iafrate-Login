<?php

require_once '../src/Lib/Sql.php';
require_once '../src/User/User.php';

use src\User\User;

try {
    $username = $_GET['username'] ?? '';
    $password = $_GET['password'] ?? '';
    $verifpassword = $_GET['verifpassword'] ?? '';

    if ($password !== $verifpassword) {
        throw new Exception("Les mots de passe ne correspondent pas.");
    }

    echo User::signUp($username, $password);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
