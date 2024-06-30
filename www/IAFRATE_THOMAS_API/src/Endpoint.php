<?php

use src\Lib\Tri;

class Endpoint {

    public static function Routing() {
        include('Lib/Tri.php');
        if (!isset($_GET['method']) || !isset($_GET['tab'])) {
            echo json_encode('Parametres manquants.');
            return;
        }
        $method = $_GET['method'];
        $tab = json_decode($_GET['tab'], true);

        if (json_last_error()) {
            echo json_encode('Le tableau contient une ou plusieurs lettres.');
            return;
        }

        if (empty($tab)) {
            echo json_encode('Le tableau est vide, veuillez entrer des chiffres.');
            return;
        }

        foreach ($tab as $item) {
            if (!is_numeric($item)) {
                echo json_encode('Le tableau contient des valeurs non numeriques.');
                return;
            }
        }

        switch($method){
            case $method === "TriInsertion" :
                $sorted_method = Tri::TriInsertion($tab);
                echo json_encode($sorted_method);
                break;
            case $method === "QuickSort" :
                $sorted_method = Tri::QuickSort($tab);
                echo json_encode($sorted_method);
                break;
            default:
                echo json_encode('Aucune methode trouve');
                break;
        }

    }
}