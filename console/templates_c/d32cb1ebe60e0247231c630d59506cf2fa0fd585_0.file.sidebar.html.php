<?php
/* Smarty version 3.1.30, created on 2019-10-16 00:08:36
  from "/home/u382053/minebars.ru/html/console/templates/main/sidebar.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da635545663f2_56723074',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd32cb1ebe60e0247231c630d59506cf2fa0fd585' => 
    array (
      0 => '/home/u382053/minebars.ru/html/console/templates/main/sidebar.html',
      1 => 1571172077,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da635545663f2_56723074 (Smarty_Internal_Template $_smarty_tpl) {
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://minotar.net/avatar/<?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
/45" class="img-circle" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
">
            </div>
            <div class="pull-left info">
                <p><?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Онлайн</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">Навигация</li>
            <?php echo $_smarty_tpl->tpl_vars['get_buttons']->value;?>

        </ul>
    </section>
</aside><?php }
}
