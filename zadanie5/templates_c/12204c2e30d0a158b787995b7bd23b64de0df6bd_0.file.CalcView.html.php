<?php
/* Smarty version 3.1.30, created on 2024-11-20 12:28:10
  from "C:\xampp\htdocs\zadanie5\app\calc\CalcView.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_673dc7ca01b1c7_07904818',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12204c2e30d0a158b787995b7bd23b64de0df6bd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\zadanie5\\app\\calc\\CalcView.html',
      1 => 1732102083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_673dc7ca01b1c7_07904818 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1203453423673dc7c9f0f3b3_52444897', 'footer');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_80434788673dc7ca007948_65464734', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender(($_smarty_tpl->tpl_vars['conf']->value->root_path).("/templates/main.html"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'footer'} */
class Block_1203453423673dc7c9f0f3b3_52444897 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
przykładowa tresć stopki wpisana do szablonu głównego z szablonu kalkulatora<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_80434788673dc7ca007948_65464734 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="pure-g">
        <div class="photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
          <a href="">
            <img
              src="/zadanie5/img/kalkulator.jpg"
              alt="kalkulator"
            />
          </a>

        </div>


<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcCompute" method="post">
	<fieldset>
		<label for="kwota_kredytu">Kwota kredytu</label>
		<input id="kwota_kredytu" type="text" placeholder="" name="kwota_kredytu" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->kwota_kredytu;?>
">
		
                <label for="lata_splaty">Lata splaty</label>
		<input id="lata_splaty" type="text" placeholder="" name="lata_splaty" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->lata_splaty;?>
">
                
                <label for="oprocentowanie">Oprocentowanie</label>
                <input id="oprocentowanie" type="text" placeholder="" name="oprocentowanie" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->oprocentowanie;?>
">
                
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>
    

<div class="messages">


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isError()) {?>
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getErrors(), 'err');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['err']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isInfo()) {?>
	<h4>Informacje: </h4>
	<ol class="inf">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getInfos(), 'inf');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['inf']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['inf']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
	<h4>Wynik</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

	</p>
<?php }?>

</div>

<?php
}
}
/* {/block 'content'} */
}
