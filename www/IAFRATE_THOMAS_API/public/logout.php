<?php

require_once '../src/User/Session.php';

use src\User\Session;

Session::start();
Session::destroy();

echo "Utilisateur déconnecté.";
