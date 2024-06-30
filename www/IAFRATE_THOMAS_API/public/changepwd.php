<?php

require_once '../middlewares/middleware.php'; // Inclure le middleware
require_once '../src/Lib/Sql.php';
require_once '../src/User/User.php';
require_once '../src/User/Session.php';

use src\User\User;
use src\User\Session;

Session::start();

try {
    $userId = $_SESSION['user_id'] ?? null;
    $oldPassword = $_GET['oldPassword'] ?? '';
    $newPassword = $_GET['newPassword'] ?? '';
    
    if ($userId) {
        echo User::changePassword($userId, $oldPassword, $newPassword);
    } else {
        echo "Erreur : Utilisateur non connecté.";
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
