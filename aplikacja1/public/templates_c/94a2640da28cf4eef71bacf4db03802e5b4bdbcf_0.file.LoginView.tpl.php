<?php
/* Smarty version 4.3.4, created on 2025-01-05 15:53:35
  from 'C:\xampp\htdocs\aplikacja1\app\views\LoginView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_677a9cefc4c165_04910104',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94a2640da28cf4eef71bacf4db03802e5b4bdbcf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\aplikacja1\\app\\views\\LoginView.tpl',
      1 => 1736088811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677a9cefc4c165_04910104 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1826025312677a9cefc25062_15857595', "title");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1034039339677a9cefc388e3_76359018', "content");
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block "title"} */
class Block_1826025312677a9cefc25062_15857595 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_1826025312677a9cefc25062_15857595',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Logowanie<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_1034039339677a9cefc388e3_76359018 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1034039339677a9cefc388e3_76359018',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    

    <section id="login" class="login-section">
        <div class="container2">
        
            <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
login" method="post" class="login-section">
                <h4>Logowanie</h4>
                    <fieldset>
                        
                        <div class="pure-control-group">
                            <label for="id_login">Login: </label>
                            <input id="id_login" type="text" name="login" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->login;?>
"/>
                        </div>
                        
                        <div class="pure-control-group">
                            <label for="id_pass">Hasło: </label>
                            <input id="id_pass" type="password" name="pass" /><br />
                        </div>
                        
                        <div class="pure-controls">
                            <input type="submit" value="Zaloguj" class="pure-button pure-button-primary">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
register" class="pure-button pure-button-secondary">Załóż konto</a>
                        </div>
                    </fieldset>
            </form>	
        </div>
    </section>
<?php
}
}
/* {/block "content"} */
}
