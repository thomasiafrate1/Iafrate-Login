<?php

namespace src\User;

class Session {
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy() {
        if (session_status() != PHP_SESSION_NONE) {
            session_unset();
            session_destroy();
        }
    }

    public static function setToken() {
        $_SESSION['token'] = bin2hex(random_bytes(16));
        $_SESSION['last_activity'] = time();
    }

    public static function updateToken() {
        $_SESSION['last_activity'] = time();
    }

    public static function isTokenValid() {
        $max_inactive_time = 1800; 
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $max_inactive_time) {
            return false;
        }
        return true;
    }
}
