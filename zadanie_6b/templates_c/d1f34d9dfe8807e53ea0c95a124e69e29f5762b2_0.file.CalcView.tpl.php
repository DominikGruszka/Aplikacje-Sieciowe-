<?php
/* Smarty version 3.1.30, created on 2024-12-08 20:37:09
  from "C:\xampp\htdocs\zadanie_6b\app\views\CalcView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6755f565a42f40_07153221',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd1f34d9dfe8807e53ea0c95a124e69e29f5762b2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\zadanie_6b\\app\\views\\CalcView.tpl',
      1 => 1733686540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_6755f565a42f40_07153221 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7098430506755f565a2f6c9_72222954', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'} */
class Block_7098430506755f565a2f6c9_72222954 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: <?php echo $_smarty_tpl->tpl_vars['user']->value->login;?>
, rola: <?php echo $_smarty_tpl->tpl_vars['user']->value->role;?>
</span>
</div>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_kwota_kredytu">Kwota_kredytu: </label>
			<input id="id_kwota_kredytu" type="text" name="kwota_kredytu" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->kwota_kredytu;?>
" />
                        
                        <label for="id_lata_splaty">Lata spłaty kredytu: </label>
			<input id="id_lata_splaty" type="text" name="lata_splaty" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->lata_splaty;?>
" />
                        
                        <label for="id_oprocentowanie">Aktualne oprocentowanie: </label>
			<input id="id_oprocentowanie" type="text" name="oprocentowanie" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->oprocentowanie;?>
" />
		</div>
   
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	

<?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
<div class="messages info">
	Wynik: <?php echo $_smarty_tpl->tpl_vars['res']->value->round('result',2);?>

</div>
<?php }?>

<?php
}
}
/* {/block 'content'} */
}
