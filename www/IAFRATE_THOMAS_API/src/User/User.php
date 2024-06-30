<?php

namespace src\User;

use src\Lib\Sql;

class User {
    private static $max_attempts = 5;
    private static $block_time = 1800;

    public static function signUp($username, $password) {
        if (!self::isValidPassword($password)) {
            throw new \Exception("Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.");
        }

        $conn = Sql::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $hashedPassword);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return "Utilisateur ajouté avec succès.";
        } else {
            $stmt->close();
            $conn->close();
            throw new \Exception("Erreur d'inscription " . $stmt->error);
        }
    }

    public static function signIn($username, $password) {
        $conn = Sql::getConnection();

        if (self::isAccountLocked($conn, $username)) {
            throw new \Exception("Compte bloqué en raison de trop nombreuses tentatives de connexion échouées. Veuillez réessayer plus tard.");
        }

        $sql = "SELECT id, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                self::clearLoginAttempts($conn, $username);
                $stmt->close();
                $conn->close();
                return "Utilisateur connecté avec succès.";
            } else {
                self::recordLoginAttempt($conn, $username);
                $stmt->close();
                $conn->close();
                throw new \Exception("Invalide nom d'utilisateur ou mot de passe.");
            }
        } else {
            $stmt->close();
            $conn->close();
            throw new \Exception("Erreur de connexion: " . $stmt->error);
        }
    }

    public static function changePassword($userId, $oldPassword, $newPassword) {
        if (!self::isValidPassword($newPassword)) {
            throw new \Exception("Le nouveau mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.");
        }

        $conn = Sql::getConnection();
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $userId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if ($user && password_verify($oldPassword, $user['password'])) {
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $sql = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('si', $hashedPassword, $userId);
                if ($stmt->execute()) {
                    $stmt->close();
                    $conn->close();
                    return "Mot de passe modifié avec succès.";
                } else {
                    $stmt->close();
                    $conn->close();
                    throw new \Exception("Erreur de changement de mot de passe " . $stmt->error);
                }
            } else {
                $stmt->close();
                $conn->close();
                throw new \Exception("Mauvais mot de passe.");
            }
        } else {
            $stmt->close();
            $conn->close();
            throw new \Exception("Erreur de changement de mot de passe " . $stmt->error);
        }
    }

    public static function isSignedIn() {
        return isset($_SESSION['user_id']);
    }

    private static function isValidPassword($password) {
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/', $password);
    }

    private static function recordLoginAttempt($conn, $username) {
        $sql = "INSERT INTO login_attempts (username) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->close();
    }

    private static function isAccountLocked($conn, $username) {
        $sql = "SELECT attempt_time FROM login_attempts WHERE username = ? ORDER BY attempt_time DESC LIMIT ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $username, self::$max_attempts);
        $stmt->execute();
        $result = $stmt->get_result();
        $attempts = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if (count($attempts) < self::$max_attempts) {
            return false;
        }

        $last_attempt_time = strtotime($attempts[self::$max_attempts - 1]['attempt_time']);
        if (time() - $last_attempt_time < self::$block_time) {
            return true;
        }

        return false;
    }

    private static function clearLoginAttempts($conn, $username) {
        $sql = "DELETE FROM login_attempts WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->close();
    }
}
