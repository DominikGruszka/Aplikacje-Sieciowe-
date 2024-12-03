<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora

include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$kwota_kredytu, &$lata_splaty, &$oprocentowanie) {
    $kwota_kredytu = isset($_REQUEST['kwota_kredytu']) ? $_REQUEST['kwota_kredytu'] : null;
    $lata_splaty = isset($_REQUEST['lata_splaty']) ? $_REQUEST['lata_splaty'] : null;
    $oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;    
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota_kredytu, &$lata_splaty, &$oprocentowanie, &$messages) {
    if (!isset($kwota_kredytu, $lata_splaty, $oprocentowanie)) {
        return false;
    }

    if ($kwota_kredytu === "") {
        $messages[] = 'Nie podano kwoty kredytu';
    }
    if ($lata_splaty === "") {
        $messages[] = 'Nie podano okresu spłaty kredytu';
    }
    if ($oprocentowanie === "") {
        $messages[] = 'Nie podano oprocentowania';
    }

    if (count($messages) != 0) return false;

    if (!is_numeric($kwota_kredytu) || $kwota_kredytu <= 0) {
        $messages[] = 'Kwota kredytu musi być liczbą dodatnią';
    }

    if (!is_numeric($lata_splaty) || $lata_splaty <= 0) {
        $messages[] = 'Okres spłaty musi być liczbą całkowitą dodatnią';
    }

    if (!is_numeric($oprocentowanie) || $oprocentowanie <= 0) {
        $messages[] = 'Oprocentowanie musi być liczbą dodatnią';
    }

    return count($messages) == 0;
}

function process(&$kwota_kredytu, &$lata_splaty, &$oprocentowanie, &$messages, &$result, $role) {
    // Sprawdzenie uprawnień na podstawie roli i parametrów
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

    // konwersja parametrów na odpowiednie typy
    $kwota_kredytu = floatval($kwota_kredytu);
    $lata_splaty = intval($lata_splaty);
    $oprocentowanie = floatval($oprocentowanie);

    // obliczenia
    $miesiace = $lata_splaty * 12;
    $miesieczna_stopa_oprocentowania = $oprocentowanie / (12 * 100);

    if ($miesieczna_stopa_oprocentowania > 0) {
        $result = $kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow((1 + $miesieczna_stopa_oprocentowania), $miesiace)) 
                  / (pow((1 + $miesieczna_stopa_oprocentowania), $miesiace) - 1);
    } else {
        $messages[] = 'Oprocentowanie nie może być zerowe lub ujemne';
    }
}

// definicja zmiennych kontrolera
$kwota_kredytu = null;
$lata_splaty = null;
$oprocentowanie = null;
$result = null;
$messages = array();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest'; // Przykładowa inicjalizacja roli użytkownika

getParams($kwota_kredytu, $lata_splaty, $oprocentowanie);
if (validate($kwota_kredytu, $lata_splaty, $oprocentowanie, $messages)) {
    process($kwota_kredytu, $lata_splaty, $oprocentowanie, $messages, $result, $role);
}

include 'calc_view.php';
?>