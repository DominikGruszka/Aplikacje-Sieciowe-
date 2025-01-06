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
            $this->form->password = ''; // Zakrycie aktualnego hasła 

            App::getSmarty()->assign('user_logged_in', $user_logged_in);
            App::getSmarty()->assign('user_name', $user_name);
            App::getSmarty()->assign('form', $this->form);

            App::getSmarty()->display('ProfileView.tpl');
        } catch (\Exception $e) {
            App::getMessages()->addMessage(new Message('Błąd podczas pobierania danych użytkownika.', Message::ERROR));
            if (App::getConf()->debug) {
                App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
            }
            header("Location: hello");
            exit();
        }
    }

    public function action_profileSave() {
        $this->form->email = trim(getFromRequest('email'));
        $this->form->lastname = trim(getFromRequest('lastname'));
        $this->form->phone = trim(getFromRequest('phone'));
        $this->form->new_password = trim(getFromRequest('new_password'));
        $this->form->repeat_new_password = trim(getFromRequest('repeat_new_password'));

        $hasErrors = false;

        if (!filter_var($this->form->email, FILTER_VALIDATE_EMAIL)) {
            App::getMessages()->addMessage(new Message('Niepoprawny adres email.', Message::ERROR));
            $hasErrors = true;
        }

        if (!preg_match('/^[0-9]{9}$/', $this->form->phone)) {
            App::getMessages()->addMessage(new Message('Numer telefonu musi składać się z 9 cyfr.', Message::ERROR));
            $hasErrors = true;
        }

        if (!empty($this->form->new_password)) {
            if (strlen($this->form->new_password) < 6) {
                App::getMessages()->addMessage(new Message('Nowe hasło musi mieć co najmniej 6 znaków.', Message::ERROR));
                $hasErrors = true;
            }

            if ($this->form->new_password !== $this->form->repeat_new_password) {
                App::getMessages()->addMessage(new Message('Nowe hasła nie są zgodne.', Message::ERROR));
                $hasErrors = true;
            }
        }

        if ($hasErrors) {
            App::getSmarty()->assign('form', $this->form);
            App::getSmarty()->display('ProfileView.tpl');
            return;
        }

        try {
            $user_id = SessionUtils::load('user_id', true);

            $update_data = [
                "email" => $this->form->email,
                "lastname" => $this->form->lastname,
                "phone" => $this->form->phone,
                "updated_at" => date("Y-m-d H:i:s")
            ];

            if (!empty($this->form->new_password)) {
                $update_data["password"] = password_hash($this->form->new_password, PASSWORD_BCRYPT);
            }

            App::getDB()->update("users", $update_data, [
                "id_users" => $user_id
            ]);

            SessionUtils::store('user_name', $this->form->lastname);

            App::getMessages()->addMessage(new Message('Zmiany zostały zapisane.', Message::INFO));
        } catch (\PDOException $e) {
            App::getMessages()->addMessage(new Message('Wystąpił błąd podczas aktualizacji danych.', Message::ERROR));
            if (App::getConf()->debug) {
                App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
            }
        }

        header("Location: profile");
        exit();
    }
}
