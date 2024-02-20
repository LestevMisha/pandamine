<?php
/* Smarty version 3.1.30, created on 2019-10-16 00:01:28
  from "/home/u382053/minebars.ru/html/console/templates/error/403.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da633a8c0b441_64043816',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '38eb01db029d879115a12ad033265a0dca4903f7' => 
    array (
      0 => '/home/u382053/minebars.ru/html/console/templates/error/403.html',
      1 => 1571172077,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da633a8c0b441_64043816 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="login-box">
    <div class="login-logo">
        <a href="/console/"><?php echo $_smarty_tpl->tpl_vars['cfg']->value['console']['title_auth'];?>
</a>
    </div>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Ошибка</strong>, у вас нет доступа к данной странице.
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <a href="/" class="btn btn-warning block full-width m-b">Купить доступ к консоли</a><br><br>
                <a href="/console/" class="btn btn-warning block full-width m-b">Перейти к главной</a>
            </div>
        </div>

    </div>
</div><?php }
}
