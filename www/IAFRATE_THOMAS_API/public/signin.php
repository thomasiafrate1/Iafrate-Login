<?php

require_once '../middlewares/middleware.php'; // Inclure le middleware
require_once '../src/Lib/Sql.php';
require_once '../src/User/User.php';
require_once '../src/User/Session.php';

use src\User\User;
use src\User\Session;

Session::start();

try {
    $username = $_GET['username'] ?? '';
    $password = $_GET['password'] ?? '';
    echo User::signIn($username, $password);
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
