<?php
/* Smarty version 3.1.30, created on 2024-11-20 10:47:13
  from "C:\xampp\htdocs\zadanie4\app\kalkulator.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_673db0211762d7_86559781',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f50a19b9e8c53a8bda1ef6f1901314cc45b1693' => 
    array (
      0 => 'C:\\xampp\\htdocs\\zadanie4\\app\\kalkulator.html',
      1 => 1732096029,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_673db0211762d7_86559781 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Kalkulator kredytowy."
    />
    <title>Kalkulator kredytowy</title>
    <link rel="stylesheet" href="/zadanie4/css/style.css" />
  </head>
  <body>
    <div>
        <h1> Kalkulator kredytowy </h1>

      <div class="pure-g">
        <div class="photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
          <a href="">
            <img
              src="/zadanie4/img/kalkulator.jpg"
              alt="kalkulator"
            />
          </a>
        </div>

       

<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/app/kalkulator.php" method="post">
	<fieldset>
		<label for="Kwota_kredytu">Kwota kredytu</label>
		<input id="kwota_kredytu" type="text" placeholder="" name="kwota_kredytu" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['kwota_kredytu'];?>
">
		
		<label for="lata_splaty">Lata spłaty kredytu</label>
		<input id="lata_splaty" type="text" placeholder="" name="lata_splaty" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['lata_splaty'];?>
">
		
		<label for="oprocentowanie">Aktualne oprocentowanie</label>
		<input id="oprocentowanie" type="text" placeholder="" name="oprocentowanie" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['oprocentowanie'];?>
">
		
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>
          </div>
        </div>
      <div class="messages">


<?php if (isset($_smarty_tpl->tpl_vars['messages']->value)) {?>
	<?php if (count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?> 
		<h4>Wystąpiły błędy: </h4>
		<ol class="err">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
?>
		<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		</ol>
	<?php }
}?>


<?php if (isset($_smarty_tpl->tpl_vars['infos']->value)) {?>
	<?php if (count($_smarty_tpl->tpl_vars['infos']->value) > 0) {?> 
		<h4>Informacje: </h4>
		<ol class="inf">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['infos']->value, 'msg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
?>
		<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		</ol>
	<?php }
}?>

<?php if (isset($_smarty_tpl->tpl_vars['wynik']->value)) {?>
    <h4>Wynik</h4>
    <p class="res">
        <?php echo round($_smarty_tpl->tpl_vars['wynik']->value,2);?>

    </p>
<?php }?>

</div>


      <div class="footer">
        Przykładowa stopka - Dominik Gruszka. Wykorzystano szablon PureCSS
      </div>
   
  </body>
</html><?php }
}
