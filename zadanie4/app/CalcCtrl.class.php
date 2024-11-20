<?php
require_once $conf->root_path . '/lib/smarty/Smarty.class.php';
require_once $conf->root_path . '/lib/Messages.class.php';
require_once $conf->root_path . '/app/CalcForm.class.php';
require_once $conf->root_path . '/app/CalcResult.class.php';

/** Kontroler kalkulatora
 * 
 */
class CalcCtrl {

    private $msgs;   // Wiadomości dla widoku
    private $form;   // Dane formularza (do obliczeń i dla widoku)
    private $wynik; // Wynik obliczeń

    /**
     * Konstruktor - inicjalizacja właściwości
     */
    public function __construct() {
        $this->msgs = new Messages();
        $this->form = new CalcForm();
        $this->wynik = new CalcResult();
    }

    /**
     * Pobranie parametrów
     */
    public function getParams() {
        $this->form->kwota_kredytu = isset($_REQUEST['kwota_kredytu']) ? $_REQUEST['kwota_kredytu'] : null;
        $this->form->lata_splaty = isset($_REQUEST['lata_splaty']) ? $_REQUEST['lata_splaty'] : null;
        $this->form->oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;
    }

    /**
     * Walidacja parametrów
     * @return bool True jeśli brak błędów, False w przeciwnym wypadku 
     */
    public function validate() {
        if (!isset($this->form->kwota_kredytu, $this->form->lata_splaty, $this->form->oprocentowanie)) {
            return false;
        }

        if ($this->form->kwota_kredytu === "") {
            $this->msgs->addError('Nie podano kwoty kredytu.');
        }
        if ($this->form->lata_splaty === "") {
            $this->msgs->addError('Nie podano liczby lat spłaty kredytu.');
        }
        if ($this->form->oprocentowanie === "") {
            $this->msgs->addError('Nie podano wartości oprocentowania.');
        }

        if (!$this->msgs->isError()) {
            if (!is_numeric($this->form->kwota_kredytu)) {
                $this->msgs->addError('Kwota kredytu musi być liczbą.');
            }
            if (!is_numeric($this->form->lata_splaty)) {
                $this->msgs->addError('Lata spłaty kredytu muszą być liczbą.');
            }
            if (!is_numeric($this->form->oprocentowanie)) {
                $this->msgs->addError('Oprocentowanie musi być liczbą.');
            }
        }

        return !$this->msgs->isError();
    }

    /**
     * Pobranie wartości, walidacja, obliczenie i wyświetlenie
     */
    public function process() {
        $this->getParams();

        if ($this->validate()) {
            // Konwersja parametrów na typy numeryczne
            $kwota_kredytu = floatval($this->form->kwota_kredytu);
            $lata_splaty = intval($this->form->lata_splaty);
            $oprocentowanie = floatval($this->form->oprocentowanie);

            $this->msgs->addInfo('Parametry poprawne.');

            // Obliczenia
            $miesiace = $lata_splaty * 12;
            $miesieczna_stopa_oprocentowania = ($oprocentowanie / 100) / 12;

            if ($miesieczna_stopa_oprocentowania == 0) {
                $wynik = $kwota_kredytu / $miesiace;
            } else {
                $wynik = $kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow(1 + $miesieczna_stopa_oprocentowania, $miesiace)) / (pow(1 + $miesieczna_stopa_oprocentowania, $miesiace) - 1);
            }

            $this->wynik->wynik = round($wynik, 2); 
            $this->msgs->addInfo('Wykonano obliczenia.');
        }

        $this->generateView();
    }

    /**
     * Wygenerowanie widoku
     */
    public function generateView() {
        global $conf;

        $smarty = new Smarty();
        $smarty->assign('conf', $conf);

        $smarty->assign('page_title', 'Zadanie4');
        $smarty->assign('page_description', 'Kalkulator kredytowy.');
        $smarty->assign('page_header', 'Kalkulator');

        $smarty->assign('msgs', $this->msgs);
        $smarty->assign('form', $this->form);
        $smarty->assign('res', $this->wynik);

        $smarty->display($conf->root_path . '/app/kalkulator.html');
    }
}
