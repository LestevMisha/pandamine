<?php
/* Smarty version 3.1.30, created on 2019-10-16 00:08:36
  from "/home/u382053/minebars.ru/html/console/templates/pages/console.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5da63554587e31_83158785',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57ba9aaad3719d45c36869257d080a270463b113' => 
    array (
      0 => '/home/u382053/minebars.ru/html/console/templates/pages/console.html',
      1 => 1571172077,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da63554587e31_83158785 (Smarty_Internal_Template $_smarty_tpl) {
?>
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Консоль</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="/console/ajax.php?type=send" id="phpmc-console">
                        <div class="input-group">
                            <input type="text" class="form-control" id="cmd" name="cmd" placeholder="Введите команду">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary" id="cmd_send" tabindex="-1"><i
                                        class="fa fa-arrow-right" aria-hidden="true"></i> Отправить
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="console-msg" class="bg-black-gradient"></div>
                    <hr>
                    <ul class="list-group">
                        <div id="console" class="log"></div>
                        <li class="list-group-item list-group-item-danger">Загружаем историю...</li>
                        <li class="list-group-item list-group-item-warning">Консоль запущена.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Доступные команды</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover ">
                        <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['commands']->value, 'cmd');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cmd']->value) {
?>
                        <tr class="info">
                            <td>/<?php echo $_smarty_tpl->tpl_vars['cmd']->value['query'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['cmd']->value['use'];?>
</td>
                        </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section><?php }
}
