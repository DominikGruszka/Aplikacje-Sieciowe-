<?php
namespace app\controllers;

use core\App;
use core\Message;
use core\SessionUtils;

class ProfileCtrl {
    private $form;

    public function __construct() {
        $this->form = new \stdClass();
    }

    public function action_profile() {
        $user_id = SessionUtils::load('user_id', true);
        $user_name = SessionUtils::load('user_name', true);
        $user_logged_in = SessionUtils::load('user_logged_in', true);

        // Domyślne wartości dla ról
        $user_is_admin = false;
        $user_is_office_worker = false;
        $user_is_workshop_worker = false;

        // Sprawdzenie ról użytkownika
        if ($user_logged_in && $user_id) {
            $db = App::getDB();

            $user_is_admin = $db->has("users_roles", [
                "[>]roles" => ["role_id" => "id_role"]
            ], [
                "users_roles.user_id" => $user_id,
                "roles.role_name" => "administrator"
            ]);

            $user_is_office_worker = $db->has("users_roles", [
                "[>]roles" => ["role_id" => "id_role"]
            ], [
                "users_roles.user_id" => $user_id,
                "roles.role_name" => "pracownik_biurowy"
            ]);

            $user_is_workshop_worker = $db->has("users_roles", [
                "[>]roles" => ["role_id" => "id_role"]
            ], [
                "users_roles.user_id" => $user_id,
                "roles.role_name" => "pracownik_warsztatowy"
            ]);
        }

        if (!$user_id) {
            App::getMessages()->addMessage(new Message('Brak zalogowanego użytkownika.', Message::ERROR));
            header("Location: login");
            exit();
        }

        try {
            $user = App::getDB()->get("users", "*", [
                "id_users" => $user_id
            ]);

            if (!$user) {
                App::getMessages()->addMessage(new Message('Nie znaleziono użytkownika.', Message::ERROR));
                header("Location: hello");
                exit();
            }

            $this->form->email = $user['email'];
            $this->form->lastname = $user['lastname'];
            $this->form->phone = $user['phone'];

            App::getSmarty()->assign('user_logged_in', $user_logged_in);
            App::getSmarty()->assign('user_name', $user_name);
            App::getSmarty()->assign('user_is_admin', $user_is_admin);
            App::getSmarty()->assign('user_is_office_worker', $user_is_office_worker);
            App::getSmarty()->assign('user_is_workshop_worker', $user_is_workshop_worker);
            App::getSmarty()->assign('form', $this->form);

            App::getSmarty()->display('ProfileView.tpl');
        } catch (\Exception $e) {
            App::getMessages()->addMessage(new Message('Błąd podczas pobierania danych użytkownika.', Message::ERROR));
            header("Location: hello");
            exit();
        }
    }
}
