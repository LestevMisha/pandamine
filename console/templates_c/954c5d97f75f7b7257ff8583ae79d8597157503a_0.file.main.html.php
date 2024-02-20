<?php
/* Smarty version 3.1.30, created on 2023-09-09 06:16:29
  from "/var/www/u0718842/data/www/pandamine.ru/pandamine/console/templates/main.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_64fbe38d9c0ca9_00870220',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '954c5d97f75f7b7257ff8583ae79d8597157503a' => 
    array (
      0 => '/var/www/u0718842/data/www/pandamine.ru/pandamine/console/templates/main.html',
      1 => 1694208153,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main/head.html' => 1,
    'file:error/".((string)$_smarty_tpl->tpl_vars[\'error\']->value).".html' => 1,
    'file:main/header.html' => 1,
    'file:main/sidebar.html' => 1,
    'file:pages/".((string)$_smarty_tpl->tpl_vars[\'page\']->value).".html' => 1,
    'file:main/footer.html' => 1,
  ),
),false)) {
function content_64fbe38d9c0ca9_00870220 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl->_subTemplateRender("file:main/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body class="hold-transition skin-blue sidebar-mini">

<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {
$_smarty_tpl->_subTemplateRender("file:error/".((string)$_smarty_tpl->tpl_vars['error']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php } else { ?>
<div class="wrapper">
    <?php $_smarty_tpl->_subTemplateRender("file:main/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->_subTemplateRender("file:main/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <div class="content-wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:pages/".((string)$_smarty_tpl->tpl_vars['page']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    </div>
    <footer class="main-footer">
        Разработано с любовью для <a href="http://pandamine.ru/">PandaMine</a>
    </footer>
</div>
<?php }
$_smarty_tpl->_subTemplateRender("file:main/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html>

<?php }
}
