<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty
require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';

//pobranie parametrów
function getParams(&$form) {
    $form['kwota_kredytu'] = isset($_POST['kwota_kredytu']) ? $_POST['kwota_kredytu'] : null;
    $form['lata_splaty'] = isset($_POST['lata_splaty']) ? $_POST['lata_splaty'] : null;
    $form['oprocentowanie'] = isset($_POST['oprocentowanie']) ? $_POST['oprocentowanie'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form, &$infos, &$msgs, &$hide_intro) {
    if (!isset($form['kwota_kredytu']) || !isset($form['lata_splaty']) || !isset($form['oprocentowanie'])) {
        return false;
    }

    $hide_intro = true;
    $infos[] = 'Przekazano parametry.';

    if ($form['kwota_kredytu'] == "") $msgs[] = 'Nie podano kwoty kredytu';
    if ($form['lata_splaty'] == "") $msgs[] = 'Nie podano lat do spłaty kredytu';
    if ($form['oprocentowanie'] == "") $msgs[] = 'Nie podano oprocentowania';

    if (count($msgs) == 0) {
        if (!is_numeric($form['kwota_kredytu'])) $msgs[] = 'Pierwsza wartość nie jest liczbą';
        if (!is_numeric($form['lata_splaty'])) $msgs[] = 'Druga wartość nie jest liczbą';
        if (!is_numeric($form['oprocentowanie'])) $msgs[] = 'Trzecia wartość nie jest liczbą';
    }

    return count($msgs) === 0;
}

// wykonaj obliczenia
function process(&$form, &$infos, &$msgs, &$wynik) {
    $infos[] = 'Parametry poprawne. Wykonuję obliczenia.';

    $kwota_kredytu = floatval($form['kwota_kredytu']);
    $lata_splaty = floatval($form['lata_splaty']);
    $oprocentowanie = floatval($form['oprocentowanie']);

    $miesiace = $lata_splaty * 12;
    $miesieczna_stopa_oprocentowania = $oprocentowanie / (12 * 100);

    if ($miesieczna_stopa_oprocentowania == 0) {
        $msgs[] = 'Oprocentowanie nie może wynosić zero przy obliczeniach kredytu.';
        $wynik = null;
        return;
    }

    $wynik = $kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) / (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1));
}

//inicjacja zmiennych
$form = array();
$infos = array();
$messages = array();
$wynik = null;

getParams($form);
if (validate($form, $infos, $messages, $hide_intro)) {
    process($form, $infos, $messages, $wynik);
}

// Przygotowanie danych dla szablonu
$smarty = new Smarty\Smarty();
$smarty->assign('app_url', _APP_URL);
$smarty->assign('root_path', _ROOT_PATH);
$smarty->assign('page_title', 'zadanie3');
$smarty->assign('page_description', 'Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header', 'Szablony Smarty');
$smarty->assign('form', $form);
$smarty->assign('wynik', $wynik);
$smarty->assign('messages', $messages);
$smarty->assign('infos', $infos);

// Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/kalkulator.html');