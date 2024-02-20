<?php
/* Smarty version 3.1.30, created on 2019-10-15 20:34:13
  from "/home/corndan/dev/dev3/console/templates/pages/cmd.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da6031580ff84_79018484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfed477be7a679c70da44ab3727b15c4c4883360' => 
    array (
      0 => '/home/corndan/dev/dev3/console/templates/pages/cmd.html',
      1 => 1571160854,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da6031580ff84_79018484 (Smarty_Internal_Template $_smarty_tpl) {
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Лог всех выполненных команд</h3>
                </div>
                <div class="box-body">
                    <table id="cmd" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Ник</th>
                            <th>ФИО</th>
                            <th>Команда</th>
                            <th>Ответ</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['log']->value, 'l');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value) {
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['nick'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['user'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['cmd'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['reply'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['time'];?>
</td>
                        </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Ник</th>
                            <th>ФИО</th>
                            <th>Команда</th>
                            <th>Ответ</th>
                            <th>Дата</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section><?php }
}
