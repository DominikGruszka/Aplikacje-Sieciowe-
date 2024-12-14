<?php

namespace app\controllers;

use app\forms\PersonEditForm;
use DateTime;
use PDOException;

class PersonEditCtrl {

    private $form; //dane formularza

    public function __construct(){
        //stworzenie potrzebnych obiektów
        $this->form = new PersonEditForm();
    }

    //validacja danych przed zapisem (nowe dane lub edycja)
    public function validateSave() {
        //0. Pobranie parametrów z walidacją
        $this->form->id_kredyty = getFromRequest('id_kredyty',true,'Błędne wywołanie aplikacji');
        $this->form->surname = getFromRequest('surname',true,'Błędne wywołanie aplikacji');
        $this->form->kwota_kredytu = getFromRequest('kwota_kredytu',true,'Błędne wywołanie aplikacji');
        $this->form->lata_splaty = getFromRequest('lata_splaty',true,'Błędne wywołanie aplikacji');
        $this->form->oprocentowanie = getFromRequest('oprocentowanie',true,'Błędne wywołanie aplikacji');

        if ( getMessages()->isError() ) return false;

        // 1. sprawdzenie czy wartości wymagane nie są puste
        if (empty(trim($this->form->surname))) {
            getMessages()->addError('Wprowadź nazwisko');
        }
        if (empty(trim($this->form->kwota_kredytu))) {
            getMessages()->addError('Wprowadź kwotę kredytu');
        }
        if (empty(trim($this->form->lata_splaty))) {
            getMessages()->addError('Wprowadź okres spłaty kredytu');
        }
        if (empty(trim($this->form->oprocentowanie))) {
            getMessages()->addError('Wprowadź aktualne oprocentowanie');
        }

        if ( getMessages()->isError() ) return false;
        
        return ! getMessages()->isError();
    }

    //validacja danych przed wyswietleniem do edycji
    public function validateEdit() {
        //pobierz parametry na potrzeby wyswietlenia danych do edycji
        //z widoku listy osób (parametr jest wymagany)
        $this->form->id_kredyty = getFromRequest('id_kredyty',true,'Błędne wywołanie aplikacji');
        return ! getMessages()->isError();
    }
    
    public function action_personNew(){
        $this->generateView();
    }
    
    //wysiweltenie rekordu do edycji wskazanego parametrem 'id'
    public function action_personEdit(){
        // 1. walidacja id osoby do edycji
        if ( $this->validateEdit() ){
            try {
                // 2. odczyt z bazy danych osoby o podanym ID (tylko jednego rekordu)
                $record = getDB()->get("kredyty", "*",[
                    "id_kredyty" => $this->form->id_kredyty
                ]);
                // 2.1 jeśli osoba istnieje to wpisz dane do obiektu formularza
                $this->form->id_kredyty = $record['id_kredyty'];
                $this->form->surname = $record['surname'];
                $this->form->kwota_kredytu = $record['kwota_kredytu'];
                $this->form->lata_splaty = $record['lata_splaty'];
                $this->form->oprocentowanie = $record['oprocentowanie'];
            } catch (PDOException $e){
                getMessages()->addError('Wystąpił błąd podczas odczytu rekordu');
                if (getConf()->debug) getMessages()->addError($e->getMessage());            
            }    
        } 
        
        // 3. Wygenerowanie widoku
        $this->generateView();        
    }

    public function action_personDelete(){        
        // 1. walidacja id osoby do usuniecia
        if ( $this->validateEdit() ){
            
            try{
                // 2. usunięcie rekordu
                getDB()->delete("kredyty",[
                    "id_kredyty" => $this->form->id_kredyty
                ]);
                getMessages()->addInfo('Pomyślnie usunięto rekord');
            } catch (PDOException $e){
                getMessages()->addError('Wystąpił błąd podczas usuwania rekordu');
                if (getConf()->debug) getMessages()->addError($e->getMessage());            
            }    
        }
        
        // 3. Przekierowanie na stronę listy osób
        forwardTo('personList');        
    }

    public function action_personSave(){
            
        // 1. Walidacja danych formularza (z pobraniem)
        if ($this->validateSave()) {
            // 2. Zapis danych w bazie
            try {
                
                //2.1 Nowy rekord
                if ($this->form->id_kredyty == '') {
                    //sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
                    $count = getDB()->count("kredyty");
                    if ($count <= 20) {
                        getDB()->insert("kredyty", [
                            "surname" => $this->form->surname,
                            "kwota_kredytu" => $this->form->kwota_kredytu,
                            "lata_splaty" => $this->form->lata_splaty,
                            "oprocentowanie" => $this->form->oprocentowanie
                        ]);
                    } else { //za dużo rekordów
                        // Gdy za dużo rekordów to pozostań na stronie
                        getMessages()->addInfo('Ograniczenie: Zbyt dużo rekordów. Aby dodać nowy usuń wybrany wpis.');
                        $this->generateView(); //pozostań na stronie edycji
                        exit(); //zakończ przetwarzanie, aby nie dodać wiadomości o pomyślnym zapisie danych
                    }
                } else { 
                //2.2 Edycja rekordu o danym ID
                    getDB()->update("kredyty", [
                        "surname" => $this->form->surname,
                        "kwota_kredytu" => $this->form->kwota_kredytu,
                        "lata_splaty" => $this->form->lata_splaty,
                        "oprocentowanie" => $this->form->oprocentowanie
                    ], [ 
                        "id_kredyty" => $this->form->id_kredyty
                    ]);
                }
                getMessages()->addInfo('Pomyślnie zapisano rekord');

            } catch (PDOException $e){
                getMessages()->addError('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (getConf()->debug) getMessages()->addError($e->getMessage());            
            }
            
            // 3b. Po zapisie przejdź na stronę listy osób (w ramach tego samego żądania http)
            forwardTo('personList');

        } else {
            // 3c. Gdy błąd walidacji to pozostań na stronie
            $this->generateView();
        }        
    }
    
    public function generateView(){
        getSmarty()->assign('form',$this->form); // dane formularza dla widoku
        getSmarty()->display('PersonEdit.tpl');
    }
}

 