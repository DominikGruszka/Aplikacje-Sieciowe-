<?php
// W skrypcie definicji kontrolera nie trzeba dołączać już niczego.
// Kontroler wskazuje tylko za pomocą 'use' te klasy z których jawnie korzysta
// (gdy korzysta niejawnie to nie musi - np używa obiektu zwracanego przez funkcję)

// Zarejestrowany autoloader klas załaduje odpowiedni plik automatycznie w momencie, gdy skrypt będzie go chciał użyć.
// Jeśli nie wskaże się klasy za pomocą 'use', to PHP będzie zakładać, iż klasa znajduje się w bieżącej
// przestrzeni nazw - tutaj jest to przestrzeń 'app\controllers'.

// Przypominam, że tu również są dostępne globalne funkcje pomocnicze - o to nam właściwie chodziło

namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResult;

class CalcCtrl {

    private $form;   // dane formularza (do obliczeń i dla widoku)
    private $result; // inne dane dla widoku

    public function __construct(){
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function getParams(){
        $this->form->kwota_kredytu = getFromRequest('kwota_kredytu');
        $this->form->lata_splaty = getFromRequest('lata_splaty');
        $this->form->oprocentowanie = getFromRequest('oprocentowanie');
    }

    public function validate() {
        if (! (isset($this->form->kwota_kredytu) && isset($this->form->lata_splaty) && isset($this->form->oprocentowanie))) {
            return false;
        }

        if ($this->form->kwota_kredytu == "") {
            getMessages()->addError('Nie podano kwoty kredytu');
        }
        if ($this->form->lata_splaty == "") {
            getMessages()->addError('Nie podano okresu do spłaty kredytu');
        }
        if ($this->form->oprocentowanie == "") {
            getMessages()->addError('Nie podano oprocentowania');
        }

        if (!getMessages()->isError()) {
            if (!is_numeric($this->form->kwota_kredytu)) {
                getMessages()->addError('Kwota kredytu nie jest liczbą');
            }
            if (!is_numeric($this->form->lata_splaty)) {
                getMessages()->addError('Okres spłaty nie jest liczbą');
            }
            if (!is_numeric($this->form->oprocentowanie)) {
                getMessages()->addError('Oprocentowanie nie jest liczbą');
            }
        }

        return !getMessages()->isError();
    }

    public function process() {
        $this->getParams();

        if ($this->validate()) {
            $this->form->kwota_kredytu = floatval($this->form->kwota_kredytu);
            $this->form->lata_splaty = intval($this->form->lata_splaty);
            $this->form->oprocentowanie = floatval($this->form->oprocentowanie);
            getMessages()->addInfo('Parametry poprawne.');

            $miesiace = $this->form->lata_splaty * 12;
            $miesieczna_stopa_oprocentowania = $this->form->oprocentowanie / (12 * 100);

            if ($miesieczna_stopa_oprocentowania == 0) {
                getMessages()->addError('Oprocentowanie nie może wynosić zero przy obliczeniach kredytu.');
                $this->result->result = null;
            } else {
                $this->result->result = round(
                    $this->form->kwota_kredytu *
                    ($miesieczna_stopa_oprocentowania * pow((1 + $miesieczna_stopa_oprocentowania), $miesiace)) /
                    (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1),
                    2
                );
                getMessages()->addInfo('Wykonano obliczenia.');
            }
        }

        $this->generateView();
    }

    public function generateView() {
        global $user;

        getSmarty()->assign('user', $user);
        getSmarty()->assign('page_title', 'Kalkulator kredytowy');
        getSmarty()->assign('form', $this->form);
        getSmarty()->assign('res', $this->result);

        getSmarty()->display('CalcView.tpl');
    }
}

