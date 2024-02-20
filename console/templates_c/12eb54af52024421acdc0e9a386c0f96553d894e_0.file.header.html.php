<?php
/* Smarty version 3.1.30, created on 2019-10-16 00:08:36
  from "/home/u382053/minebars.ru/html/console/templates/main/header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da635545443d7_98963274',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12eb54af52024421acdc0e9a386c0f96553d894e' => 
    array (
      0 => '/home/u382053/minebars.ru/html/console/templates/main/header.html',
      1 => 1571172077,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da635545443d7_98963274 (Smarty_Internal_Template $_smarty_tpl) {
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
