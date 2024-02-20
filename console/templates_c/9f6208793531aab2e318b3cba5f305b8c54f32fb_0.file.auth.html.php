<?php
/* Smarty version 3.1.30, created on 2019-10-15 19:22:22
  from "/home/corndan/dev/dev3/console/templates/error/auth.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da5f23edeabb5_10016394',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f6208793531aab2e318b3cba5f305b8c54f32fb' => 
    array (
      0 => '/home/corndan/dev/dev3/console/templates/error/auth.html',
      1 => 1571156537,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da5f23edeabb5_10016394 (Smarty_Internal_Template $_smarty_tpl) {
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
