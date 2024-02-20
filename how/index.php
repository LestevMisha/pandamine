<!-- saved from url=(0027)http://mine-crew.ru/?go=how -->
<html>

<head>
    <meta charset="utf-8">
    <title>PandaMine - Как купить?</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include '../header/wp_head.php' ?>

    <style>
        body {
            background: url(img/bgtopdonate4.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body>
    <?php include '../header/header.php' ?>

    <div style="margin-top:5em;"></div>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel panel-default">
                        <center>
                            <a href="http://PandaMine.ru/" class="btn btn-success">Приобрести привилегию</a>
                            <h1 style="color:black;">1. Введи ник и выбери привилегию</h1>
                            <p style="color:black;">которую хочешь купить, а затем нажми на кнопку <strong>купить/доплатить</strong></p>
                            <img src="./img/HOWS.png" class="img-responsive">
                            <hr>
                            <h1 style="color:black;">2. Выбери нужный способ оплаты</h1>
                            <p style="color:black;">QIWI, Карты, Яндекс.Деньги, телефон и т.д.</p>
                            <img src="./img/7HO5JGp.png" class="img-responsive">
                            <hr>
                            <h1 style="color:black;">3. Введи свой номер телефона</h1>
                            <p style="color:black;">или лицевого счета, все зависит от выбранного способа оплаты</p>
                            <img src="./img/o3ifIJm.png" class="img-responsive">
                            <hr>
                            <h1 style="color:black;">4. Перейди к оплате</h1>
                            <p style="color:black;">но для начала введи пароль от сервиса оплаты (если требуется)</p>
                            <img src="./img/tpmQ3Gi.png" class="img-responsive">
                            <hr>
                            <h1 style="color:black;">5. Успешно!</h1>
                            <p style="color:black;">вы будете перенаправлены на сайт платежной системы<br>
                            <p style="color:black;">теперь достаточно зайти на сервер под своим ником и наслаждаться игрой с привилегией!<br>
                                <img src="./img/BOLBS8J.png" class="img-responsive">
                                <hr>
                            <h1 style="color:black;">Возникли проблемы?</h1>
                            <p style="color:black;">Ты всегда можешь обратиться в нашу службу поддержки!</p>
                            <p style="color:black;">PandaMine.ru/support</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter45325305 = new Ya.Metrika({
                        id: 45325305,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true
                    });
                } catch (e) {}
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
        $.post('/engine/ajax.php?type=donaters', {}, function(data) {
            $('#last_donaters').html(data);
        });
    </script>
    <noscript>
        &lt;div&gt;&lt;img src="https://mc.yandex.ru/watch/45325305" style="position:absolute; left:-9999px;" alt="" /&gt;&lt;/div&gt;
    </noscript>
    <!-- /Yandex.Metrika counter -->
    <script>
        var timer_key; //Хранение id таймера
        $('#phpmc input, #phpmc select, #phpmc textarea').on('keydown change', function() { //Обработчик нажате кливиш на все инпуты внутри формы
            clearTimeout(timer_key);
            timer_key = setTimeout(function() {
                $.get('/engine/ajax.php', {
                    type: 'form_new',
                    nick: $('#nick').val(),
                    group: $('#group option:selected').val()
                }, function(text) {
                    var str = text
                    var matches = str.split('|')
                    $('#buy').text(matches[1]);
                    $('#info').html(matches[2]);
                });
            }, 50);
        });
        $.post('/engine/ajax.php?type=online', {}, function(data) {
            $('#online').html(data);
        });
        $.post('/engine/ajax.php?type=slots', {}, function(data) {
            $('#slots').html(data);
        });
    </script>

</body>

</html>