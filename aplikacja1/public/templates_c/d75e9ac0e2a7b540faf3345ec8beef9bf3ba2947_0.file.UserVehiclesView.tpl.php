<?php
/* Smarty version 4.3.4, created on 2025-01-06 11:37:36
  from 'C:\xampp\htdocs\aplikacja1\app\views\UserVehiclesView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_677bb27045a838_67030208',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd75e9ac0e2a7b540faf3345ec8beef9bf3ba2947' => 
    array (
      0 => 'C:\\xampp\\htdocs\\aplikacja1\\app\\views\\UserVehiclesView.tpl',
      1 => 1736159716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677bb27045a838_67030208 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1691739503677bb2704375b7_14793079', "title");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_856451970677bb27043b430_11893890', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block "title"} */
class Block_1691739503677bb2704375b7_14793079 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_1691739503677bb2704375b7_14793079',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Pojazdy użytkownika<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_856451970677bb27043b430_11893890 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_856451970677bb27043b430_11893890',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\aplikacja1\\lib\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<section id="user-vehicles" class="user-vehicles-section">
    <div class="container">
        <h1>Pojazdy użytkownika</h1>
        <table class="pure-table">
            <thead>
                <tr>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Rok produkcji</th>
                    <th>VIN</th>
                    <th>Data rejestracji</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vehicles']->value, 'vehicle');
$_smarty_tpl->tpl_vars['vehicle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['vehicle']->value) {
$_smarty_tpl->tpl_vars['vehicle']->do_else = false;
?>
                <tr>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['vehicle']->value['brand'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['vehicle']->value['model'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['vehicle']->value['production_year'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['vehicle']->value['vin'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vehicle']->value['created_at'],"%Y-%m-%d %H:%M:%S");?>
</td>
                </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
        <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
adminPanel" class="pure-button pure-button-primary">Powrót do panelu</a>
    </div>
</section>
<?php
}
}
/* {/block "content"} */
}
