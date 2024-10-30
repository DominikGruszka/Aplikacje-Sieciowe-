<?php 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator kredytowy</title>
</head>
<body>

<div style="width:90%; margin: 2em auto;">
    <a href="<?php print(_APP_ROOT); ?>/app/inna_ochrona.php" class="pure-button">Chroniona strona</a>
    <a href="<?php print(_APP_ROOT); ?>/app/ochrona/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">
    <form action="<?php print(_APP_URL); ?>/app/kalkulator.php" method="post" class="pure-form pure-form-stacked">
        <h1>Kalkulator kredytowy <br /></h1>
        <fieldset>
            <label for="id_kwota_kredytu">Podaj kwotę kredytu: </label>
            <input id="id_kwota_kredytu" type="text" name="kwota_kredytu" value="<?php echo isset($kwota_kredytu) ? $kwota_kredytu : ''; ?>" /><br />
            
            <label for="id_lata_splaty">Ile lat chcesz spłacać kredyt: </label>
            <input id="id_lata_splaty" type="text" name="lata_splaty" value="<?php echo isset($lata_splaty) ? $lata_splaty : ''; ?>" /><br />
            
            <label for="id_oprocentowanie">Podaj aktualne oprocentowanie: </label>
            <input id="id_oprocentowanie" type="text" name="oprocentowanie" value="<?php echo isset($oprocentowanie) ? $oprocentowanie : ''; ?>" /><br />
        </fieldset>    
        <input type="submit" value="Oblicz" />
    </form>

    <?php
    if (isset($messages) && count($messages) > 0) {
        echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
        foreach ($messages as $msg) {
            echo '<li>' . $msg . '</li>';
        }
        echo '</ol>';
    }
    ?>
    <?php if (isset($wynik)){ ?>
    <div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">
        <?php echo 'Wynik: ' . round($wynik, 2); ?>
    </div>
    <?php } ?>
</div>

</body>
</html>