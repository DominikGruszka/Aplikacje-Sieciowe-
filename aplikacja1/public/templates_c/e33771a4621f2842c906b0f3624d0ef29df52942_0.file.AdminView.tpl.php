<?php
/* Smarty version 4.3.4, created on 2025-01-07 22:07:15
  from 'C:\xampp\htdocs\aplikacja1\app\views\AdminView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_677d9783bf1107_02771475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e33771a4621f2842c906b0f3624d0ef29df52942' => 
    array (
      0 => 'C:\\xampp\\htdocs\\aplikacja1\\app\\views\\AdminView.tpl',
      1 => 1736283947,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d9783bf1107_02771475 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1287941079677d9783bb6783_61585182', "title");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_333280836677d9783bca003_42369281', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block "title"} */
class Block_1287941079677d9783bb6783_61585182 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_1287941079677d9783bb6783_61585182',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Panel Administratora<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_333280836677d9783bca003_42369281 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_333280836677d9783bca003_42369281',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\aplikacja1\\lib\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<section id="admin-panel" class="admin-panel-section">
    <div class="container">
        <h1>Panel Administratora</h1>
        <h2>Lista użytkowników</h2>
        <table class="pure-table">
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Nazwisko</th>
                    <th>Rola</th>
                    <th>Data przypisania</th>
                    <th>Akcje</th>
                    <th>Pojazdy</th>
                    <th>Usuń użytkownika</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
                <tr>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['login'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['lastname'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['user']->value['role_name'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php if ((isset($_smarty_tpl->tpl_vars['user']->value['created_at']))) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['created_at'],"%Y-%m-%d %H:%M:%S");
} else { ?>-<?php }?></td>
                    <td>
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
assignRole">
    <select name="role_id" required>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roles']->value, 'role');
$_smarty_tpl->tpl_vars['role']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['role']->value) {
$_smarty_tpl->tpl_vars['role']->do_else = false;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['role']->value['id_role'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['role']->value['role_name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </select>
    <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id_users'];?>
">
    <button type="submit" class="pure-button pure-button-primary">Przypisz</button>
</form>

                        <?php if ((isset($_smarty_tpl->tpl_vars['user']->value['user_role_id']))) {?>
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
removeRole">
                            <input type="hidden" name="user_role_id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['user_role_id'];?>
">
                            <button type="submit" class="pure-button pure-button-secondary">Usuń</button>
                        </form>
                        <?php }?>
                    </td>
                    <td>
                        <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
userVehicles">
                            <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id_users'];?>
">
                            <button type="submit" class="pure-button pure-button-primary">Pokaż pojazdy</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
deleteUser">
                            <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id_users'];?>
">
                            <button type="submit" class="pure-button pure-button-error">Usuń użytkownika</button>
                        </form>
                    </td>
                </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    </div>
</section>
<?php
}
}
/* {/block "content"} */
}
