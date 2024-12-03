<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<h3>Kalkulator kredytowy</h2>

<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
	<fieldset>
		<label for="kwota_kredytu">Kwota kredytu</label>
		<input id="kwota_kredytu" type="text" placeholder="wartość x" name="kwota_kredytu" value="<?php out($form['kwota_kredytu']); ?>">
                
                <label for="lata_splaty">Okres spłaty kredytu</label>
		<input id="lata_splaty" type="text" placeholder="wartość x" name="lata_splaty" value="<?php out($form['lata_splaty']); ?>">
                
                <label for="oprocentowanie">Oprocentowanie</label>
		<input id="oprocentowanie" type="text" placeholder="wartość x" name="oprocentowanie" value="<?php out($form['oprocentowanie']); ?>">

	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
	echo '<h4>Wystąpiły błędy: </h4>';
	echo '<ol class="err">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php
//wyświeltenie listy informacji, jeśli istnieją
if (isset($infos)) {
	if (count ( $infos ) > 0) {
	echo '<h4>Informacje: </h4>';
	echo '<ol class="inf">';
		foreach ( $infos as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
	<h4>Wynik</h4>
	<p class="res">
<?php print(round($result,2)); ?>
	</p>
<?php } ?>

</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>