<?php
namespace core;

use core\App;
use core\SessionUtils;

class BaseCtrl {
    public function loadUserSessionData() {
        $user_logged_in = SessionUtils::load('user_logged_in', true);
        $user_name = SessionUtils::load('user_name', true);
        $user_role = SessionUtils::load('user_role', true);

       // Sprawdzenie, czy użytkownik jest administratorem
        $user_is_admin = ($user_role === 'administrator');

        // Przekazanie danych do widoków
        App::getSmarty()->assign('user_logged_in', $user_logged_in);
        App::getSmarty()->assign('user_name', $user_name);
        App::getSmarty()->assign('user_is_admin', $user_is_admin);
    }
}
