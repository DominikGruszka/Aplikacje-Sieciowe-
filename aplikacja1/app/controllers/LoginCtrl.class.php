<?php
namespace app\controllers;

use app\forms\LoginForm;
use core\App;
use core\Message;
use core\SessionUtils;

class LoginCtrl {
    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function validate() {
        $this->form->login = getFromRequest('login');
        $this->form->pass = getFromRequest('pass');

        if (!isset($this->form->login)) return false;

        if (empty($this->form->login)) {
            App::getMessages()->addMessage(new Message('Nie podano loginu', Message::ERROR));
        }
        if (empty($this->form->pass)) {
            App::getMessages()->addMessage(new Message('Nie podano hasła', Message::ERROR));
        }

        if (App::getMessages()->isError()) return false;

        $db = App::getDB();
        try {
            // Pobierz dane użytkownika
            $user = $db->get("users", ["id_users", "login", "password"], [
                "login" => $this->form->login
            ]);

            if (!$user || $this->form->pass !== $user['password']) {
                App::getMessages()->addMessage(new Message('Niepoprawny login lub hasło', Message::ERROR));
                return false;
            }

            // Pobierz rolę użytkownika
            $role = $db->get("users_roles", [
                "[>]roles" => ["role_id" => "id_role"]
            ], [
                "roles.role_name"
            ], [
                "user_id" => $user['id_users']
            ]);

            // Zapisz dane do sesji
            SessionUtils::store('user_logged_in', true);
            SessionUtils::store('user_name', $user['login']);
            SessionUtils::store('user_id', $user['id_users']);
            SessionUtils::store('user_role', $role['role_name'] ?? null); // Domyślnie null, jeśli brak roli

            return true;

        } catch (\Exception $e) {
            App::getMessages()->addMessage(new Message('Błąd połączenia z bazą danych', Message::ERROR));
            return false;
        }
    }

    public function action_loginShow() {
        $this->generateView();
    }

    public function action_login() {
        if ($this->validate()) {
            App::getMessages()->addMessage(new Message('Poprawnie zalogowano do systemu', Message::INFO));
            header("Location: hello");
            exit();
        } else {
            $this->generateView();
        }
    }

    public function action_logout() {
        SessionUtils::clear();
        header("Location: hello");
        exit();
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('LoginView.tpl');
    }
}
