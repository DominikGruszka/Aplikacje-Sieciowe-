<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator kredytowy</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/kalkulator.php" method="post">
	<h1>Kalkulator kredytowy <br /></h1>

	<label for="id_x">Podaj kwotę kredytu: </label>
	<input id="id_x" type="text" name="x" value="<?php echo isset($x) ? $x : ''; ?>" /><br />
	
	<label for="id_y">Ile lat chcesz spłacać kredyt: </label>
	<input id="id_y" type="text" name="y" value="<?php echo isset($y) ? $y : ''; ?>" /><br />
	
	<label for="id_z">Podaj aktualne oprocentowanie: </label>
	<input id="id_z" type="text" name="z" value="<?php echo isset($z) ? $z : ''; ?>" /><br />
	
	<input type="submit" value="Oblicz" />
</form>

<?php
if (isset($messages) && count($messages) > 0) {
	echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
	foreach ($messages as $msg) {
		echo '<li>'.$msg.'</li>';
	}
	echo '</ol>';
}
?>

<?php if (isset($rwynik) && $rwynik): ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
	<?php echo 'Wynik: ' . round($wynik, 2); ?>
</div>
<?php endif; ?>

</body>
</html>