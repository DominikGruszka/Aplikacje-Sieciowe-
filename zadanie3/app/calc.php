<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__) . '/../config.php';

// Funkcja pobierająca parametry
function getParams(&$form) {
    $form['kwota_kredytu'] = isset($_REQUEST['kwota_kredytu']) ? $_REQUEST['kwota_kredytu'] : null;
    $form['lata_splaty'] = isset($_REQUEST['lata_splaty']) ? $_REQUEST['lata_splaty'] : null;
    $form['oprocentowanie'] = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;    
}

// Funkcja walidująca dane wejściowe
function validate(&$form, &$infos, &$msgs, &$hide_intro) {
    if (!(isset($form['kwota_kredytu']) && isset($form['lata_splaty']) && isset($form['oprocentowanie']))) {
        return false;
    }

    $hide_intro = true;
    $infos[] = 'Przekazano parametry.';

    if ($form['kwota_kredytu'] === "") $msgs[] = 'Nie podano kwoty kredytu';
    if ($form['lata_splaty'] === "") $msgs[] = 'Nie podano okresu do spłaty kredytu';
    if ($form['oprocentowanie'] === "") $msgs[] = 'Nie podano wielkości oprocentowania';

    if (count($msgs) === 0) {
        if (!is_numeric($form['kwota_kredytu'])) $msgs[] = 'Podana kwota kredytu nie jest liczbą';
        if (!is_numeric($form['lata_splaty'])) $msgs[] = 'Podany okres nie jest liczbą';
        if (!is_numeric($form['oprocentowanie'])) $msgs[] = 'Podane oprocentowanie nie jest liczbą';
    }

    return count($msgs) === 0;
}

// Funkcja przetwarzająca dane
function process(&$form, &$infos, &$msgs, &$result) {
    $infos[] = 'Parametry poprawne. Wykonuję obliczenia.';

    $kwota_kredytu = floatval($form['kwota_kredytu']);
    $lata_splaty = floatval($form['lata_splaty']);
    $oprocentowanie = floatval($form['oprocentowanie']);

    $miesiace = $lata_splaty * 12;
    $miesieczna_stopa_oprocentowania = $oprocentowanie / (12 * 100);

    if ($miesieczna_stopa_oprocentowania > 0) {
        $result = $kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow((1 + $miesieczna_stopa_oprocentowania), $miesiace)) 
                  / (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1);
    } else {
        $msgs[] = 'Oprocentowanie nie może być zerowe lub ujemne';
    }
}

// Inicjalizacja zmiennych
$form = null;
$infos = array();
$msgs = array();
$result = null;
$hide_intro = false;

// Obsługa logiki kontrolera
getParams($form);
if (validate($form, $infos, $msgs, $hide_intro)) {
    process($form, $infos, $msgs, $result);
}

// Ustawienia widoku
$page_title = 'Kalkulator kredytowy';
$page_description = 'Zadanie numer 3';
$page_header = '';
$page_footer = 'DG';

include 'calc_view.php';