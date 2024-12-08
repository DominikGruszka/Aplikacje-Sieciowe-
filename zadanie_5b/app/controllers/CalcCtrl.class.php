<?php
// W skrypcie definicji kontrolera nie trzeba dołączać już niczego.
// Kontroler wskazuje tylko za pomocą 'use' te klasy z których jawnie korzysta
// (gdy korzysta niejawnie to nie musi - np używa obiektu zwracanego przez funkcję)

// Zarejestrowany autoloader klas załaduje odpowiedni plik automatycznie w momencie, gdy skrypt będzie go chciał użyć.
// Jeśli nie wskaże się klasy za pomocą 'use', to PHP będzie zakładać, iż klasa znajduje się w bieżącej
// przestrzeni nazw - tutaj jest to przestrzeń 'app\controllers'.

// Przypominam, że tu również są dostępne globalne funkcje pomocnicze - o to nam właściwie chodziło

namespace app\controllers;

// Zamieniamy 'require' na 'use', wskazując jedynie przestrzeń nazw, w której znajduje się klasa
use app\forms\CalcForm;
use app\transfer\CalcResult;

/** Kontroler kalkulatora
 * @author Przemysław Kudłacik
 */
class CalcCtrl {

    private $form;   // dane formularza (do obliczeń i dla widoku)
    private $result; // inne dane dla widoku

    /** 
     * Konstruktor - inicjalizacja właściwości
     */
    public function __construct(){
        // stworzenie potrzebnych obiektów
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }
    
    /** 
     * Pobranie parametrów
     */
    public function getParams(){
        $this->form->kwota_kredytu = getFromRequest('kwota_kredytu'); // Poprawiono nazwę właściwości
        $this->form->lata_splaty = getFromRequest('lata_splaty');
        $this->form->oprocentowanie = getFromRequest('oprocentowanie');
    }
    
    /** 
     * Walidacja parametrów
     * @return true jeśli brak błędów, false w przeciwnym wypadku 
     */
    public function validate() {
        // sprawdzenie, czy parametry zostały przekazane
        if (! (isset ( $this->form->kwota_kredytu ) && isset ( $this->form->lata_splaty ) && isset ( $this->form->oprocentowanie ))) {
            // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
            return false;
        }
        
        // sprawdzenie, czy potrzebne wartości zostały przekazane
        if ($this->form->kwota_kredytu == "") {
            getMessages()->addError('Nie podano kwoty kredytu');
        }
        if ($this->form->lata_splaty == "") {
            getMessages()->addError('Nie podano okresu do spłaty kredytu');
        }
        if ($this->form->oprocentowanie == "") {
            getMessages()->addError('Nie podano oprocentowania');
        }
        
        // nie ma sensu walidować dalej, gdy brak parametrów
        if (! getMessages()->isError()) {
            if (! is_numeric($this->form->kwota_kredytu)) {
                getMessages()->addError('Pierwsza wartość nie jest liczbą całkowitą');
            }
            if (! is_numeric($this->form->lata_splaty)) {
                getMessages()->addError('Druga wartość nie jest liczbą całkowitą');
            }
            if (! is_numeric($this->form->oprocentowanie)) {
                getMessages()->addError('Trzecia wartość nie jest liczbą całkowitą');
            }
        }
        
        return ! getMessages()->isError();
    }
    
    /** 
     * Pobranie wartości, walidacja, obliczenie i wyświetlenie
     */
    public function process(){
        $this->getParams();
        
        if ($this->validate()) {
            // konwersja parametrów na int
            $this->form->kwota_kredytu = floatval($this->form->kwota_kredytu); // Poprawiono typ na float
            $this->form->lata_splaty = intval($this->form->lata_splaty);
            $this->form->oprocentowanie = floatval($this->form->oprocentowanie); // Poprawiono literówkę w nazwie właściwości

            getMessages()->addInfo('Parametry poprawne.');
            
            $miesiace = $this->form->lata_splaty * 12;
            $miesieczna_stopa_oprocentowania = ($this->form->oprocentowanie / 100) / 12;

            if ($miesieczna_stopa_oprocentowania == 0) {
                $rata = $this->form->kwota_kredytu / $miesiace;
            } else {
                $rata = $this->form->kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow(1 + $miesieczna_stopa_oprocentowania, $miesiace)) / (pow(1 + $miesieczna_stopa_oprocentowania, $miesiace) - 1);
            }

            $this->result->result = round($rata, 2); 
            getMessages()->addInfo('Wykonano obliczenia.');
        }
        
        $this->generateView();
    }
    
    /**
     * Wygenerowanie widoku
     */
    public function generateView(){
        // Nie trzeba już tworzyć Smarty i przekazywać mu konfiguracji i messages
        // - wszystko załatwia funkcja getSmarty()
        
        getSmarty()->assign('page_title','Kalkulator kredytowy');
        getSmarty()->assign('page_description','Zadanie5b');
        getSmarty()->assign('page_header','');
                    
        getSmarty()->assign('form',$this->form);
        getSmarty()->assign('res',$this->result);
        
        getSmarty()->display('CalcView.tpl'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
    }
}