<?php
/* Smarty version 4.3.4, created on 2025-01-05 15:55:50
  from 'C:\xampp\htdocs\aplikacja1\app\views\ProfileView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_677a9d76c86cb8_19182794',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af0cc0f1a271785072f0a3cb5b45c7e152a9ab2b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\aplikacja1\\app\\views\\ProfileView.tpl',
      1 => 1736088910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677a9d76c86cb8_19182794 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_563923344677a9d769b4230_46256325', "title");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_87939651677a9d769c7ab5_75104090', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block "title"} */
class Block_563923344677a9d769b4230_46256325 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_563923344677a9d769b4230_46256325',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Profil użytkownika<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_87939651677a9d769c7ab5_75104090 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_87939651677a9d769c7ab5_75104090',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section id="profile" class="profile-section">
        <div class="container2">
            <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
profileSave" method="post" class="pure-form pure-form-aligned">
                <h4>Twój profil</h4>
            <fieldset>
                <div class="pure-control-group">
                    <label for="id_email">Email:</label>
                    <input id="id_email" type="email" name="email" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['form']->value->email, ENT_QUOTES, 'UTF-8', true);?>
">
                </div>
                
                <div class="pure-control-group">
                    <label for="id_lastname">Nazwisko:</label>
                    <input id="id_lastname" type="text" name="lastname" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['form']->value->lastname, ENT_QUOTES, 'UTF-8', true);?>
">
                </div>
                
                <div class="pure-control-group">
                    <label for="id_phone">Numer telefonu:</label>
                    <input id="id_phone" type="tel" name="phone" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['form']->value->phone, ENT_QUOTES, 'UTF-8', true);?>
">
                </div>
                
                <div class="pure-control-group">
                    <label for="id_password">Aktualne hasło:</label>
                    <input id="id_password" type="password" name="password" placeholder="Wpisz aktualne hasło" readonly>
                </div>
                
                <div class="pure-control-group">
                    <label for="id_new_password">Nowe hasło:</label>
                    <input id="id_new_password" type="password" name="new_password" placeholder="Wpisz nowe hasło">
                </div>
                
                <div class="pure-control-group">
                    <label for="id_repeat_new_password">Powtórz nowe hasło:</label>
                    <input id="id_repeat_new_password" type="password" name="repeat_new_password" placeholder="Powtórz nowe hasło">
                </div>
                
                <div class="pure-controls">
                    <input type="submit" value="Zapisz zmiany" class="pure-button pure-button-primary">
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
