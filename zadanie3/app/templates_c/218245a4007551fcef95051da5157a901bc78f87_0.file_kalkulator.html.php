<?php
/* Smarty version 5.4.1, created on 2024-11-16 13:29:36
  from 'file:C:\xampp\htdocs\zadanie3/app/kalkulator.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_673890304bdf50_23183492',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '218245a4007551fcef95051da5157a901bc78f87' => 
    array (
      0 => 'C:\\xampp\\htdocs\\zadanie3/app/kalkulator.html',
      1 => 1731760165,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_673890304bdf50_23183492 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\zadanie3\\app';
?><!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Kalkulator kredytowy."
    />
    <title>Kalkulator kredytowy</title>
    <link rel="stylesheet" href="/zadanie3/css/style.css" />
  </head>
  <body>
    <div>
        <h1> Kalkulator kredytowy </h1>

      <div class="pure-g">
        <div class="photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
          <a href="">
            <img
              src="/zadanie3/img/kalkulator.jpg"
              alt="kalkulator"
            />
          </a>

          <aside class="photo-box-caption">
            <span
              >
              <a href="http://www.dillonmcintosh.tumblr.com/"
                ></a
              ></span
            >
          </aside>
        </div>

       

<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->getValue('app_url');?>
/app/kalkulator.php" method="post">
	<fieldset>
		<label for="Kwota_kredytu">Kwota kredytu</label>
		<input id="kwota_kredytu" type="text" placeholder="" name="kwota_kredytu" value="<?php echo $_smarty_tpl->getValue('form')['kwota_kredytu'];?>
">
		
		<label for="lata_splaty">Lata spłaty kredytu</label>
		<input id="lata_splaty" type="text" placeholder="" name="lata_splaty" value="<?php echo $_smarty_tpl->getValue('form')['lata_splaty'];?>
">
		
		<label for="oprocentowanie">Aktualne oprocentowanie</label>
		<input id="oprocentowanie" type="text" placeholder="" name="oprocentowanie" value="<?php echo $_smarty_tpl->getValue('form')['oprocentowanie'];?>
">
		
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>
          </div>
        </div>
      <div class="messages">

<?php if ((null !== ($_smarty_tpl->getValue('messages') ?? null))) {?>
	<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('messages')) > 0) {?> 
		<h4>Wystąpiły błędy: </h4>
		<ol class="err">
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
		<li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((null !== ($_smarty_tpl->getValue('infos') ?? null))) {?>
	<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('infos')) > 0) {?> 
		<h4>Informacje: </h4>
		<ol class="inf">
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('infos'), 'msg');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach1DoElse = false;
?>
		<li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((null !== ($_smarty_tpl->getValue('wynik') ?? null))) {?>
    <h4>Wynik</h4>
    <p class="res">
        <?php echo round((float) $_smarty_tpl->getValue('wynik'), (int) 2, (int) 1);?>

    </p>
<?php }?>

</div>


      <div class="footer">
        Przykładowa stopka - Dominik Gruszka. Wykorzystano szablon PureCSS
      </div>
   
  </body>
</html><?php }
}
