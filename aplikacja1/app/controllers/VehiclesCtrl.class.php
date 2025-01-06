<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\SessionUtils;

class VehiclesCtrl {
    private $form;

    public function __construct() {
        $this->form = new \app\forms\VehiclesForm();
        $this->form->brand = '';
        $this->form->model = '';
        $this->form->production_year = '';
        $this->form->vin = '';
    }

    public function action_vehicles() {
        
      // Pobranie danych sesji
        $user_logged_in = SessionUtils::load('user_logged_in', true);
        $user_name = SessionUtils::load('user_name', true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form->brand = trim(getFromRequest('brand'));
            $this->form->model = trim(getFromRequest('model'));
            $this->form->production_year = trim(getFromRequest('production_year'));
            $this->form->vin = trim(getFromRequest('vin'));

            $hasErrors = false;

            if (empty($this->form->brand)) {
                App::getMessages()->addMessage(new Message('Marka pojazdu jest wymagana.', Message::ERROR));
                $hasErrors = true;
            }
            if (empty($this->form->model)) {
                App::getMessages()->addMessage(new Message('Model pojazdu jest wymagany.', Message::ERROR));
                $hasErrors = true;
            }
            if (empty($this->form->production_year) || !is_numeric($this->form->production_year) || strlen($this->form->production_year) != 4) {
                App::getMessages()->addMessage(new Message('Rok produkcji musi być poprawnym rokiem (4 cyfry).', Message::ERROR));
                $hasErrors = true;
            }
            if (empty($this->form->vin) || strlen($this->form->vin) != 17) {
                App::getMessages()->addMessage(new Message('Numer VIN musi mieć dokładnie 17 znaków.', Message::ERROR));
                $hasErrors = true;
            }
            
            if (!$hasErrors) {
                try {
                    $user_id = SessionUtils::load('user_id', true); 

                    App::getDB()->insert("vehicles", [
                        "user_id" => $user_id,
                        "brand" => $this->form->brand,
                        "model" => $this->form->model,
                        "production_year" => $this->form->production_year,
                        "vin" => $this->form->vin,
                        "created_at" => date("Y-m-d H:i:s")
                    ]);

                    App::getMessages()->addMessage(new Message('Pojazd został zapisany pomyślnie.', Message::INFO));
                } catch (\PDOException $e) {
                    App::getMessages()->addMessage(new Message('Wystąpił błąd podczas zapisu pojazdu.', Message::ERROR));
                    if (App::getConf()->debug) {
                        App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                    }
                }
            }
        }

        App::getSmarty()->assign('user_logged_in', $user_logged_in);
        App::getSmarty()->assign('user_name', $user_name);
        App::getSmarty()->assign('form', $this->form);

        App::getSmarty()->display('VehiclesView.tpl');
    }
}
