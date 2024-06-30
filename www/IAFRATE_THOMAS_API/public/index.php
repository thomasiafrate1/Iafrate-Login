<?php
require_once '../middlewares/middleware.php'; // Inclure le middleware
require_once '../src/Lib/Sql.php';
use src\Lib\Sql;

try {
    $action = $_GET['action'] ?? '';
    $id = $_GET['id'] ?? null;
    $nom = $_GET['nom'] ?? '';
    $prenom = $_GET['prenom'] ?? '';
    $age = $_GET['age'] ?? null;

    $resultat = Sql::gererAction($action, $id, $nom, $prenom, $age);
    echo $resultat;
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
