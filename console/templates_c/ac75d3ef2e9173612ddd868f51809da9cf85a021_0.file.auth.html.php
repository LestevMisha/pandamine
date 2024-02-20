<?php
/* Smarty version 3.1.30, created on 2023-09-09 06:16:29
  from "/var/www/u0718842/data/www/pandamine.ru/pandamine/console/templates/error/auth.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_64fbe38d9d2920_24800344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac75d3ef2e9173612ddd868f51809da9cf85a021' => 
    array (
      0 => '/var/www/u0718842/data/www/pandamine.ru/pandamine/console/templates/error/auth.html',
      1 => 1694208153,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64fbe38d9d2920_24800344 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="login-box">
    <div class="login-logo">
        <a href="/console/"><?php echo $_smarty_tpl->tpl_vars['cfg']->value['console']['title_auth'];?>
</a>
    </div>
    <div class="alert alert-dismissible alert-danger text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Для доступа вам необходимо войти, <br>для этого воспользуйтесь кнопкой ниже.
    </div>
    <div class="login-box-body">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <a href="https://oauth.vk.com/authorize?client_id=<?php echo $_smarty_tpl->tpl_vars['cfg']->value['console']['vk_id'];?>
&scope=email,wall&redirect_uri=http://<?php echo $_smarty_tpl->tpl_vars['cfg']->value['console']['auth_url'];?>
/auth.php"
                   class="btn btn-primary block full-width m-b">Войти через Вконакте</a><br><br>
                <a href="/" class="btn btn-warning block full-width m-b">Перейти к покупке доната</a>
            </div>
        </div>

    </div>
</div><?php }
}
