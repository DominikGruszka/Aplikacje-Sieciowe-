<?php
/* Smarty version 4.3.4, created on 2025-01-05 16:21:14
  from 'C:\xampp\htdocs\aplikacja1\app\views\RentalsView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_677aa36a6fbeb1_35413770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d21b576f0739c6ae73228477823349f8e8b1707' => 
    array (
      0 => 'C:\\xampp\\htdocs\\aplikacja1\\app\\views\\RentalsView.tpl',
      1 => 1736089141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677aa36a6fbeb1_35413770 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1387572787677aa36a6d4db0_39695475', "title");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1300605005677aa36a6e8636_75380831', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block "title"} */
class Block_1387572787677aa36a6d4db0_39695475 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_1387572787677aa36a6d4db0_39695475',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Samochody do Wynajęcia - RideFlow<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_1300605005677aa36a6e8636_75380831 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1300605005677aa36a6e8636_75380831',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <section class="rental-cars">
        <div class="container">
            <h1>Samochody do wynajęcia</h1>
            <div class="cars">
                
            <!--  Pierwszy samochód -->
            <div class="card">
                <div class="image-box">
                    <img src="renault.jpg"/>
                </div>
            <div class="content10">
                <h2>Renault Traffic</h2>
                    <p>Rok produkcji 2020<br> 9 miejsc <br> śr. spalanie 10 l.<br> cena od 300zł/dzień</p>
                    
            </div>
            </div>       
            
            <!--  Drugi samochód -->
            <div class="card">
                <div class="image-box">
                    <img src="renault.jpg"/>
                </div>
            <div class="content10">
                <h2>Renault Traffic</h2>
                    <p>Rok produkcji 2020<br> 9 miejsc <br> śr. spalanie 10 l.<br> cena od 300zł/dzień</p>
                    
            </div>
            </div> 
            
            <!--  Trzeci samochód -->
            <div class="card">
                <div class="image-box">
                    <img src="renault.jpg"/>
                </div>
            <div class="content10">
                <h2>Renault Traffic</h2>
                    <p>Rok produkcji 2020<br> 9 miejsc <br> śr. spalanie 10 l.<br> cena od 300zł/dzień</p>
                    
            </div>
            </div> 
            </div>
        </div>
    </section>
<?php
}
}
/* {/block "content"} */
}
