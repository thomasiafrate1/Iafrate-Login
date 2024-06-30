<?php

namespace src\Lib;

class Sql {
    private static $cred = null;

    private static function loadCredentials() {
        if (self::$cred === null) {
            $credPath = $_SERVER['DOCUMENT_ROOT'] . '/../mdp/credentials.json';
            self::$cred = json_decode(file_get_contents($credPath));
        }
    }

    private static function connect() {
        self::loadCredentials();
        $conn = new \mysqli(self::$cred->host, self::$cred->username, self::$cred->password, self::$cred->dbname);
        if ($conn->connect_error) {
            throw new \Exception("Échec de la connexion : " . $conn->connect_error);
        }
        return $conn;
    }

    public static function getConnection() {
        return self::connect();
    }

    public static function ajouterUtilisateur($nom, $prenom, $age) {
        $conn = self::connect();
        $sql = "INSERT INTO utilisateurs (nom, prenom, age) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $nom, $prenom, $age);

        if ($stmt->execute()) {
            $last_id = $conn->insert_id;
            $stmt->close();
            $conn->close();
            return "Utilisateur ajouté avec succès. ID: $last_id";
        } else {
            $stmt->close();
            $conn->close();
            throw new \Exception("Erreur d'exécution : " . $stmt->error);
        }
    }

    public static function modifierUtilisateur($id, $nom, $prenom, $age) {
        $conn = self::connect();
        $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, age = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssii', $nom, $prenom, $age, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return "Utilisateur modifié avec succès.";
        } else {
            $stmt->close();
            $conn->close();
            throw new \Exception("Erreur d'exécution : " . $stmt->error);
        }
    }

    public static function supprimerUtilisateur($id) {
        $conn = self::connect();
        $sql = "DELETE FROM utilisateurs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return "Utilisateur supprimé avec succès.";
        } else {
            $stmt->close();
            $conn->close();
            throw new \Exception("Erreur d'exécution : " . $stmt->error);
        }
    }

    public static function afficherUtilisateur($id) {
        $conn = self::connect();
        $sql = "SELECT * FROM utilisateurs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $stmt->close();
            $conn->close();
            return $result->fetch_assoc();
        } else {
            $stmt->close();
            $conn->close();
            throw new \Exception("Erreur d'exécution : " . $stmt->error);
        }
    }

    public static function gererAction($action, $id, $nom, $prenom, $age) {
        switch($action) {
            case 'ajouter':
                return self::ajouterUtilisateur($nom, $prenom, $age);
            case 'modifier':
                return self::modifierUtilisateur($id, $nom, $prenom, $age);
            case 'supprimer':
                return self::supprimerUtilisateur($id);
            case 'afficher':
                $utilisateur = self::afficherUtilisateur($id);
                return $utilisateur ? "Utilisateur trouvé : " . print_r($utilisateur, true) : "Aucun utilisateur trouvé.";
            default:
                throw new \Exception("Action non valide.");
        }
    }
}
