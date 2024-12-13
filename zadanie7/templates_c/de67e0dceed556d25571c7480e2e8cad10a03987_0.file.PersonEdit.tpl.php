<?php
/* Smarty version 3.1.30, created on 2024-12-13 20:21:04
  from "C:\xampp\htdocs\zadanie7\app\views\PersonEdit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_675c8920031089_89066793',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'de67e0dceed556d25571c7480e2e8cad10a03987' => 
    array (
      0 => 'C:\\xampp\\htdocs\\zadanie7\\app\\views\\PersonEdit.tpl',
      1 => 1734117444,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_675c8920031089_89066793 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_134855785675c892002d205_96866867', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_134855785675c892002d205_96866867 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
personSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane osoby oraz kredytu</legend>
		<div class="pure-control-group">
            <label for="surname">Nazwisko</label>
            <input id="surname" type="text" placeholder="nazwisko" name="surname" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->surname;?>
">
        </div>
		<div class="pure-control-group">
            <label for="rata_kredytu">Rata kredytu</label>
            <input id="rata_kredytu" type="text" placeholder="rata_kredytu" name="rata_kredytu" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->rata_kredytu;?>
">
        </div>
		<div class="pure-control-group">
            <label for="lata_splaty">Okres spłaty kredytu</label>
            <input id="lata_splaty" type="text" placeholder="lata_splaty" name="lata_splaty" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->lata_splaty;?>
">
        </div>
                <div class="pure-control-group">
            <label for="oprocentowanie">Aktualne oprocentowanie</label>
            <input id="oprocentowanie" type="text" placeholder="oprocentowanie" name="oprocentowanie" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->oprocentowanie;?>
">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
personList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->id;?>
">
</form>	
</div>

<?php
}
}
/* {/block 'top'} */
}
