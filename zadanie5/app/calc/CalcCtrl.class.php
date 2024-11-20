<?php
require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/calc/CalcForm.class.php';
require_once $conf->root_path.'/app/calc/CalcResult.class.php';

class CalcCtrl {
    private $msgs;
    private $form;
    private $result;

    public function __construct() {
        $this->msgs = new Messages();
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function getParams() {
        $this->form->kwota_kredytu = isset($_REQUEST['kwota_kredytu']) ? $_REQUEST['kwota_kredytu'] : null;
        $this->form->lata_splaty = isset($_REQUEST['lata_splaty']) ? $_REQUEST['lata_splaty'] : null;
        $this->form->oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;
    }

    public function validate() {
        if (!isset($this->form->kwota_kredytu, $this->form->lata_splaty, $this->form->oprocentowanie)) {
            return false;
        }

        if ($this->form->kwota_kredytu === "") {
            $this->msgs->addError('Nie podano kwoty kredytu');
        }
        if ($this->form->lata_splaty === "") {
            $this->msgs->addError('Nie podano okresu spłaty');
        }
        if ($this->form->oprocentowanie === "") {
            $this->msgs->addError('Nie podano wielkości oprocentowania');
        }

        if (!$this->msgs->isError()) {
            if (!is_numeric($this->form->kwota_kredytu)) {
                $this->msgs->addError('Kwota kredytu musi być liczbą');
            }
            if (!is_numeric($this->form->lata_splaty)) {
                $this->msgs->addError('Okres spłaty musi być liczbą');
            }
            if (!is_numeric($this->form->oprocentowanie)) {
                $this->msgs->addError('Oprocentowanie musi być liczbą');
            }
        }

        return !$this->msgs->isError();
    }

    public function process() {
    $this->getParams();

    if ($this->validate()) {
        // Konwersja parametrów na wartości liczbowe
        $this->form->kwota_kredytu = floatval($this->form->kwota_kredytu);
        $this->form->lata_splaty = floatval($this->form->lata_splaty);
        $this->form->oprocentowanie = floatval($this->form->oprocentowanie);
        
        $this->msgs->addInfo('Parametry poprawne.');

        // Obliczenia
        $miesiace = $this->form->lata_splaty * 12;
        $miesieczna_stopa_oprocentowania = $this->form->oprocentowanie / (12 * 100);

        if ($miesieczna_stopa_oprocentowania == 0) {
            $this->msgs->addError('Oprocentowanie nie może wynosić zero przy obliczeniach kredytu.');
            $this->result->result = null; 
        } else {
            // Obliczenie wyniku
            $this->result->result = $this->form->kwota_kredytu * 
                ($miesieczna_stopa_oprocentowania * 
                pow((1 + $miesieczna_stopa_oprocentowania), $miesiace)) /
                (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1);

            $this->msgs->addInfo('Wykonano obliczenia.');
        }
    }

    $this->generateView();
}

    public function generateView() {
        global $conf;

        $smarty = new Smarty();
        $smarty->assign('conf', $conf);
        $smarty->assign('msgs', $this->msgs);
        $smarty->assign('form', $this->form);
        $smarty->assign('res', $this->result);
        $smarty->display($conf->root_path.'/app/calc/CalcView.html');
    }
}