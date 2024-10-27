<?php
require_once dirname(__FILE__).'/config.php';

$messages = [];
$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
$z = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;

if (!(isset($x) && isset($y) && isset($z))) {
	$messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów. Wpisz prawidłowe dane';
}

if ($x === "") {
	$messages[] = 'Nie podano kwoty kredytu';
}
if ($y === "") {
	$messages[] = 'Nie podano ilości lat do spłaty kredytu';
}
if ($z === "") {
	$messages[] = 'Nie podano aktualnego oprocentowania';
}

if (empty($messages)) {
	if (!is_numeric($x)) {
		$messages[] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	if (!is_numeric($y)) {
		$messages[] = 'Druga wartość nie jest liczbą całkowitą';
	}
	if (!is_numeric($z)) {
		$messages[] = 'Trzecia wartość nie jest liczbą całkowitą';
	}
}

if (empty($messages)) {
	$x = floatval($x);
	$y = floatval($y);
	$z = floatval($z);
	
	$miesiace = $y * 12;
	$miesieczna_stopa_oprocentowania = $z / (12 * 100);
	
	$wynik = $x * ($miesieczna_stopa_oprocentowania * pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) / (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1));
	$rwynik = true;
}

include 'kalkulator_kredytowy.php';