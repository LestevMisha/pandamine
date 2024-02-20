<?php
/* Smarty version 3.1.30, created on 2019-10-15 19:47:55
  from "/home/corndan/dev/dev3/console/templates/main/header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da5f83b5863b0_26145228',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d2db541297f57e7eca071d566140f523d9cd4ee' => 
    array (
      0 => '/home/corndan/dev/dev3/console/templates/main/header.html',
      1 => 1571158075,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da5f83b5863b0_26145228 (Smarty_Internal_Template $_smarty_tpl) {
?>
<header class="main-header">
    <a href="/console/" class="logo">
        <span class="logo-mini"><?php echo $_smarty_tpl->tpl_vars['cfg']->value['console']['title_small'];?>
</span>
        <span class="logo-lg"><?php echo $_smarty_tpl->tpl_vars['cfg']->value['console']['title_size'];?>
</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
    </nav>
</header><?php }
}
