<?php

require_once '../src/User/Session.php';

use src\User\Session;

Session::start();

if (!Session::isTokenValid()) {
    Session::destroy();
    echo "La session a expiré. Veuillez vous reconnecter.";
    exit;
} else {
    Session::updateToken();
}
