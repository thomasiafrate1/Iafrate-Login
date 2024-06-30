<?php

require_once '../src/User/Session.php';
require_once '../src/User/User.php';

use src\User\Session;
use src\User\User;

Session::start();

if (User::isSignedIn()) {
    echo "Compte utilisateur connecté.";
} else {
    echo "Compte utilisateur non connecté.";
}
