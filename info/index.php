<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PandaMine - Информация</title>
    <meta name="description" content="Minecraft сервер PandaMine. Айпи адрес майнкрафт сервера pandamine.ru">
    <?php include '../header/wp_head.php' ?>
    <style>
        body {
            margin: 0 auto;
            background: url(../img/bg.png);
        }

        .content {
            margin-top: 50px;
        }

        .content form {
            margin-top: 20px;
        }

        footer,
        .footer {
            height: 100px;
        }

        .embed-responsive {
            max-height: 50px;
        }

        .line {
            border: none;
            background-color: gray;
            color: gray;
            height: 2px;
            margin-top: 15px;
        }

        .lin {
            width: 600px;
            border: none;
            background-color: black;
            color: gray;
            height: 2px;
            margin-top: 15px;
        }

        .modal-body .alert-info {
            max-height: 400px;
            overflow-y: scroll;
        }

        .thumbnail:hover {
            background-color: rgba(255, 242, 0, 0.3);
        }
    </style>
</head>

<body>

    <?php include '../header/header.php' ?>

    <div class="modal fade" id="lite" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии ЛАЙТ</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/lite-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="premium" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Премиум</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/premium-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="creative" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Креатив</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/creative-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="moder" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Модератор</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/moder-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="lord" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Лорд</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/lord-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="admin" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Админ</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/admin-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="s-admin" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии S-Админ</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/sadmin-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delux" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Делюкс</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/delux-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ultra" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Ультра</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/ultra-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="direktor" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Директор</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/direktor-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="korol" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Информация о привилегии Король</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="img/donates/korol-info.png" class="img-responsive">
                    </center>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <br>

            <center>
                <div class="lin"></div>
                <h1>ОПИСАНИЕ ПРИВИЛЕГИЙ</h1>
                <div class="lin"></div>
            </center>
            <br>

            <div class="row">
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#lite">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>ЛАЙТ</h2>
                        </center>
                        <img src="img/donates/lite.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#premium">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>ПРЕМИУМ</h2>
                        </center>
                        <img src="img/donates/premium.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#creative">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>КРЕАТИВ</h2>
                        </center>
                        <img src="img/donates/creative.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#moder">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>МОДЕР</h2>
                        </center>
                        <img src="img/donates/moder.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#lord">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>ЛОРД</h2>
                        </center>
                        <img src="img/donates/lord.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#admin">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>АДМИН</h2>
                        </center>
                        <img src="img/donates/admin.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2 col-md-offset-1" data-toggle="modal" data-target="#s-admin">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>S-АДМИН</h2>
                        </center>
                        <img src="img/donates/s-admin.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#delux">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>ДЕЛЮКС</h2>
                        </center>
                        <img src="img/donates/delux.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#ultra">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>УЛЬТРА</h2>
                        </center>
                        <img src="img/donates/ultra.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#direktor">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>ДИРЕКТОР</h2>
                        </center>
                        <img src="img/donates/direktor.png">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2" data-toggle="modal" data-target="#korol">
                    <a href="#" class="thumbnail">
                        <center>
                            <h2>КОРОЛЬ</h2>
                        </center>
                        <img src="img/donates/korol.png">
                    </a>
                </div>
            </div>
        </div>

        <script src="js/common.js"></script>
        <script src="js/sales.js"></script>
        <script src="js/my.js"></script>
</body>

</html>