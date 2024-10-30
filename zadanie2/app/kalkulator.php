<?php
require_once dirname(__FILE__) . '/../config.php';

$kwota_kredytu = null;
$lata_splaty = null;
$oprocentowanie = null;
$wynik = null;
$messages = [];

session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest'; 

function getParams(&$kwota_kredytu, &$lata_splaty, &$oprocentowanie) {
    $kwota_kredytu = isset($_POST['kwota_kredytu']) ? $_POST['kwota_kredytu'] : null;
    $lata_splaty = isset($_POST['lata_splaty']) ? $_POST['lata_splaty'] : null;
    $oprocentowanie = isset($_POST['oprocentowanie']) ? $_POST['oprocentowanie'] : null;
}

function validate(&$kwota_kredytu, &$lata_splaty, &$oprocentowanie, &$messages) {
    if ($kwota_kredytu == null || $lata_splaty == null || $oprocentowanie == null) {
        $messages[] = 'Wszystkie pola są wymagane.';
        return false;
    }
    
    if (!is_numeric($kwota_kredytu) || !is_numeric($lata_splaty) || !is_numeric($oprocentowanie)) {
        $messages[] = 'Wszystkie wartości muszą być liczbami.';
        return false;
    }
    
    return true;
}

function process(&$kwota_kredytu, &$lata_splaty, &$oprocentowanie, &$messages, &$wynik, $role) {
    if ($oprocentowanie < 5) {
        if ($role !== 'manager') {
            $messages[] = 'Tylko manager banku może obliczyć ratę kredytu przy oprocentowaniu poniżej 5%.';
            return;
        }
    }
    
    if ($lata_splaty > 35) {
        if ($role !== 'pracownik' && $role !== 'manager') {
            $messages[] = 'Tylko pracownik lub manager mogą obliczać ratę kredytu, gdy okres spłaty jest większy niż 35 lat.';
            return;
        }
    }

    $kwota_kredytu = floatval($kwota_kredytu);
    $lata_splaty = intval($lata_splaty);
    $oprocentowanie = floatval($oprocentowanie);

    $miesiace = $lata_splaty * 12;
    $miesieczna_stopa_oprocentowania = $oprocentowanie / (12 * 100);

    $wynik = $kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) / (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1));
}

getParams($kwota_kredytu, $lata_splaty, $oprocentowanie);
if (validate($kwota_kredytu, $lata_splaty, $oprocentowanie, $messages)) { 
    process($kwota_kredytu, $lata_splaty, $oprocentowanie, $messages, $wynik, $role);
}

include _ROOT_PATH . '/app/kalkulator_kredytowy.php';
?>