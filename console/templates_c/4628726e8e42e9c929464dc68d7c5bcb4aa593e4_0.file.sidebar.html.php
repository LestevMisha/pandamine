<?php
/* Smarty version 3.1.30, created on 2019-10-15 19:40:58
  from "/home/corndan/dev/dev3/console/templates/main/sidebar.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da5f69aec3194_40176172',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4628726e8e42e9c929464dc68d7c5bcb4aa593e4' => 
    array (
      0 => '/home/corndan/dev/dev3/console/templates/main/sidebar.html',
      1 => 1571157657,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da5f69aec3194_40176172 (Smarty_Internal_Template $_smarty_tpl) {
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
