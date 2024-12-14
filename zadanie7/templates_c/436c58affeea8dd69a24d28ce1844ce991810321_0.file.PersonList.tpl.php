<?php
/* Smarty version 3.1.30, created on 2024-12-14 14:54:51
  from "C:\xampp\htdocs\zadanie7\app\views\PersonList.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_675d8e2bb1a5b3_53121831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '436c58affeea8dd69a24d28ce1844ce991810321' => 
    array (
      0 => 'C:\\xampp\\htdocs\\zadanie7\\app\\views\\PersonList.tpl',
      1 => 1734184488,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_675d8e2bb1a5b3_53121831 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_277439278675d8e2baf34b9_17653304', 'top');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1731130470675d8e2bb06d35_30996424', 'bottom');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_277439278675d8e2baf34b9_17653304 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
personList">
	<legend>Opcje wyszukiwania</legend>
	<fieldset>
		<input type="text" placeholder="nazwisko" name="sf_surname" value="<?php echo $_smarty_tpl->tpl_vars['searchForm']->value->surname;?>
" /><br />
		<button type="submit" class="pure-button pure-button-primary">Filtruj</button>
	</fieldset>
</form>
</div>	

<?php
}
}
/* {/block 'top'} */
/* {block 'bottom'} */
class Block_1731130470675d8e2bb06d35_30996424 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<a class="pure-button button-success" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
personNew">+ Nowa osoba</a>
</div>	

<table id="tab_people" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>nazwisko</th>
		<th>kwota kredytu</th>
		<th>okres spłaty</th>
		<th>oprocentowanie</th>
                <th>opcje</th>
	</tr>
</thead>
<tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['people']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
<tr><td><?php echo $_smarty_tpl->tpl_vars['p']->value["surname"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["kwota_kredytu"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["lata_splaty"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["oprocentowanie"];?>
</td><td><a class="button-small pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
personEdit&id_kredyty=<?php echo $_smarty_tpl->tpl_vars['p']->value['id_kredyty'];?>
">Edytuj</a>&nbsp;<a class="button-small pure-button button-warning" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
personDelete&id_kredyty=<?php echo $_smarty_tpl->tpl_vars['p']->value['id_kredyty'];?>
">Usuń</a></td></tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</tbody>
</table>

<?php
}
}
/* {/block 'bottom'} */
}
