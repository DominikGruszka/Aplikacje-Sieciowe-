<?php
require_once dirname(__FILE__).'/../config.php';

$messages = [];
$kwota_kredytu = isset($_REQUEST['kwota_kredytu']) ? $_REQUEST['kwota_kredytu'] : null;
$lata_splaty = isset($_REQUEST['lata_splaty']) ? $_REQUEST['lata_splaty'] : null;
$oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;

if (!(isset($kwota_kredytu) && isset($lata_splaty) && isset($oprocentowanie))) {
	$messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów. Wpisz prawidłowe dane';
}

if ($kwota_kredytu === "") {
	$messages[] = 'Nie podano kwoty kredytu';
}
if ($lata_splaty === "") {
	$messages[] = 'Nie podano ilości lat do spłaty kredytu';
}
if ($oprocentowanie === "") {
	$messages[] = 'Nie podano aktualnego oprocentowania';
}

if (empty($messages)) {
	if (!is_numeric($kwota_kredytu)) {
		$messages[] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	if (!is_numeric($lata_splaty)) {
		$messages[] = 'Druga wartość nie jest liczbą całkowitą';
	}
	if (!is_numeric($oprocentowanie)) {
		$messages[] = 'Trzecia wartość nie jest liczbą całkowitą';
	}
}

if (empty($messages)) {
	$kwota_kredytu = floatval($kwota_kredytu);
	$lata_splaty = floatval($lata_splaty);
	$oprocentowanie = floatval($oprocentowanie);
	
	$miesiace = $lata_splaty * 12;
	$miesieczna_stopa_oprocentowania = $oprocentowanie / (12 * 100);
	
	$wynik = $kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) / (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1));
	$rwynik = true;
}

include 'kalkulator_kredytowy.php';