<?php
/* Smarty version 3.1.30, created on 2023-09-09 06:16:29
  from "/var/www/u0718842/data/www/pandamine.ru/pandamine/console/templates/main/footer.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_64fbe38d9d7eb2_61974732',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69ae9736e51371cfa63e6b7ca95235bb10d46a07' => 
    array (
      0 => '/var/www/u0718842/data/www/pandamine.ru/pandamine/console/templates/main/footer.html',
      1 => 1694208153,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64fbe38d9d7eb2_61974732 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- jQuery 2.2.3 -->
<?php echo '<script'; ?>
 src="styles/plugins/jQuery/jquery-2.2.3.min.js"><?php echo '</script'; ?>
>
<!-- Bootstrap 3.3.6 -->
<?php echo '<script'; ?>
 src="styles/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<!-- FastClick -->
<?php echo '<script'; ?>
 src="styles/plugins/fastclick/fastclick.js"><?php echo '</script'; ?>
>
<!-- AdminLTE App -->
<?php echo '<script'; ?>
 src="styles/js/app.min.js"><?php echo '</script'; ?>
>
<!-- Sparkline -->
<?php echo '<script'; ?>
 src="styles/plugins/sparkline/jquery.sparkline.min.js"><?php echo '</script'; ?>
>
<!-- jvectormap -->
<?php echo '<script'; ?>
 src="styles/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="styles/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"><?php echo '</script'; ?>
>
<!-- SlimScroll 1.3.0 -->
<?php echo '<script'; ?>
 src="styles/plugins/slimScroll/jquery.slimscroll.min.js"><?php echo '</script'; ?>
>
<!-- ChartJS 1.0.1 -->
<?php echo '<script'; ?>
 src="styles/plugins/chartjs/Chart.min.js"><?php echo '</script'; ?>
>
<!-- AdminLTE for demo purposes -->
<?php echo '<script'; ?>
 src="styles/js/demo.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['page']->value == "console") {
echo '<script'; ?>
>
    function console_update() {
        $.ajax({
            url: "/console/ajax.php?type=get_log",
            cache: false,
            success: function (html) {
                $("#console").html(html);
            }
        });
    }

    $(document).ready(function () {
        console_update();
        setInterval('console_update()', 1000);
    });

    var console = $('#phpmc-console');
    console.submit(function (ev) {
        $('#cmd_send').prop('disabled', true).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Отправка...');
        $.ajax({
            type: console.attr('method'),
            url: console.attr('action'),
            data: console.serialize(),
            success: function (data) {
                var data = JSON.parse(data);
                var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                var type = (data.type == "ok") ? 'Успешно' : 'Ошибка';
                $('#console-msg').html("<div> " + time + " > " + type + "! " + data.msg + "</div>");
                $('#cmd_send').prop('disabled', false).html('<i class="fa fa-arrow-right" aria-hidden="true"></i> Отправить');
            }
        });

        ev.preventDefault();
    });
<?php echo '</script'; ?>
>
<?php } elseif ($_smarty_tpl->tpl_vars['page']->value == "cmd") {
echo '<script'; ?>
 src="styles/plugins/datatables/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="styles/plugins/datatables/dataTables.bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(function () {
        $("#cmd").DataTable({
            "order": [[4, "desc"]],
            language: {
                processing: "Выполняется обработка...",
                search: "Поиск: ",
                lengthMenu: "Показать _MENU_ записей",
                info: "Показано с _START_ до _END_ из _TOTAL_ записей",
                infoEmpty: "Записей нет",
                infoFiltered: "<br>(отфильтровано _MAX_ записей)",
                infoPostFix: "",
                loadingRecords: "Загрузка...",
                zeroRecords: "Записи не обнаружены",
                emptyTable: "Нет доступных в таблице данных",
                paginate: {
                    first: "Первая",
                    previous: "Назад",
                    next: "Вперед",
                    last: "Последняя"
                },
                aria: {
                    sortAscending: ": активировать для сортировки столбца по возрастанию",
                    sortDescending: ": активировать для сортировки столбцов по убыванию"
                }
            }
        });
    });
<?php echo '</script'; ?>
>
<?php }
}
}
