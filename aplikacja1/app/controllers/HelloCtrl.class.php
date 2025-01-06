<?php
namespace app\controllers;

use core\App;
use core\SessionUtils;

class HelloCtrl {

    public function action_hello() {
        
      // Pobranie z sesji informacji czy użytkownik jest zalogowany oraz jego nazwy
        $user_logged_in = SessionUtils::load('user_logged_in', true);
        $user_name = SessionUtils::load('user_name', true);
        $user_id = SessionUtils::load('user_id', true);

      // Domyślnie zakładam, że użytkownik nie jest administratorem
        $user_is_admin = false;

      // Sprawdzenie w bazie danych, czy użytkownik ma rolę administratora
        if ($user_logged_in && $user_id) {
            $user_is_admin = App::getDB()->has("users_roles", [
                "[>]roles" => ["role_id" => "id_role"]
            ], [
                "users_roles.user_id" => $user_id,
                "roles.role_name" => "administrator"
            ]);
        }

        App::getSmarty()->assign('user_logged_in', $user_logged_in);
        App::getSmarty()->assign('user_name', $user_name);
        App::getSmarty()->assign('user_is_admin', $user_is_admin);

        App::getSmarty()->display('HelloView.tpl');
    }
}

