<?php
   include 'classes/Main.class.php';
   $main = new Main();
?>
<html>
   <head>
      <meta charset="utf-8">
      <title>PandaMine - Покупка доната, привилегий, кейсов на сервере Minecraft</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/js/script.js"></script>
	  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
	  <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
      <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="http://bootswatch.com/spacelab/bootstrap.css" rel="stylesheet" type="text/css">
	  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
       <style>
           .panelServers .form-control{
               height: 41px;
               font-size: 16px;
           }
           .panelServers .panel-heading .nav-tabs{
               padding-left: 15px;
               padding-right: 15px;
           }
           .panelServers .panel-heading{
               background: none;
               border: none;
               padding-left: 0;
               padding-right: 0;
           }
       </style>
   </head>
   <body>
  <style>
   body {
        background: url(images/bg22.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
   }
  </style>
<style>
.img-thumbnail, .alert-success, .alert-danger, .panel { 
box-shadow: 0px 0px 30px 10px rgba(0, 0, 0, .5); 
}
</style>
      <div class="navbar navbar-default navbar-static-top">
         <div class="container">
            <div class="navbar-header">
               <a href="/" class="navbar-brand"><span class="fa fa-eye"></span> PandaMine</a>
               <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
               <ul class="nav navbar-nav navbar-left">
                  <li><a href="https://vk.com/pandamine" target="_blank">Мы ВКонтакте</a>
                  </li>
                  <li><a href="http://PandaMine.ru/rules" target="_self">Правила</a>
                  </li>
                  <li><a href="http://PandaMine.ru/info" target="_self">Инфо о донате</a>
                  </li>
                  <li><a href="http://PandaMine.ru/how" target="_self">Как купить?</a>
                  </li>
                  <li><a href="http://PandaMine.ru/console" target="_blank">Консоль</a></li>
                  </li>
                  <li><a href="#" data-toggle="modal" data-target="#basicModal">Контакты</a>
				  </li>
                  <li><a href="https://vk.com/topic-137408919_39651148" target="_blank">Отзывы</a>
				  </li>
        <li class="dropdown">
          <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
            Другое
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
			<li><a href="http://PandaMine.ru/guard">Безопасность</a></li>
			<li><a href="http://PandaMine.ru/faq">FAQ</a></li>
            <li class="divider"></li>
	        <li><a href="https://vk.me/pandamine">Тех.поддержка</a></li>
          </ul>
        </li>
               <ul class="nav navbar-nav navbar-right">
                  <a href="http://PandaMine.ru/" class="btn btn-warning navbar-btn navbar-right hidden-sm hidden-xs" onclick="prompt('Скопируйте наш IP адрес и вставьте в ваш клиент:','pandamc.ru'); return false;">
                  IP сервера: pandamc.ru
                  </a>
               </ul>
            </div>
         </div>
      </div>
	  
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="myModalLabel">Контакты</h4>
            </div>
            <div class="modal-body">
                <p> <a href="https://vk.me/pandamine" target="_blank">● Тех.поддержка</a>
                </p>
                <p> <a href="https://vk.com/pandamine" target="_blank">● Группа ВКонтакте</a>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
        <div class="col-md-12">
            <center><img src="./images/color.jpg" class="img-thumbnail"></center>
            <br>
        </div>

      <div class="section">
         <div class="container">
            <div class="row">
               <div class="col-md-8 col-md-offset-2">
                  <?php foreach($main->messages as $message){ ?>
                  <div class="row">
                     <div class="col-md-12">
                        <?php if($message['err']){ ?>
                        <div class="alert alert-dismissible alert-danger">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong><?=$message['text']?></strong>
                        </div>
                           <?php } else { ?>
                        <div class="alert alert-dismissible alert-success">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong><?=$message['text']?></strong>
                        </div>
                        <?php } ?>
                     </div></div>
                  <?php } ?>
                  <div class="alert alert-dismissable alert-success text-center">
                     <button contenteditable="false" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <?= $main->cfg['message'] ?>
                  </div>
        <div class="alert alert-dismissible alert-danger text-center">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Внимание! </strong> Чтобы доплатить, введите ник, выберите привилегию и нажмите доплатить.
            <br>
        </div>	
                  <div class="panel panel-default panelServers">
                      <div class="panel-heading">
                          <ul class="nav nav-tabs tabsServers">
                              <?php $i = 0;foreach ($main->cfg['servers'] as $srv_name=>$srv) {$i++;?>
                                  <li role="presentation" class="<?= $i==1?'active':'' ?>"><a href="#srv-<?=$i?>" data-toggle="tab"><?=$srv_name?></a></li>
                              <?php } ?>
                          </ul>
                      </div>
                     <div class="panel-body">
                        <div id="myTabContent" class="tab-content">
                           <?php $i = 0;foreach ($main->cfg['servers'] as $srv_name=>$srv) {$i++;?>
                           <div class="tab-pane fade in <?= $i==1?'active':''?>" id="srv-<?=$i?>">
                              <form method="post" class="phpmc_buy" data-ready="0" action="/">
                                 <input type="hidden" name="srv_id" class="input-srv_id" value="<?= $srv['srv_id'] ?>">
								  <div class="alert alert-dismissable alert-warning text-center">
									 Вы выбрали: <strong><?=$srv_name?></strong>
								  </div>
                                 <div class="form-group has-feedback">
                                    <label for="nick" class="control-label">Введите ваш ник:</label>
                                    <input type="text" name="nick" class="form-control input-nick" required="" placeholder="Введите ваш ник">
                                 </div>
                                 <div class="form-group">
                                    <label for="group" class="control-label">Выберите привилегию:</label>
                                    <select name="group" class="form-control select-group" required="">
                                       <option selected="" disabled="">Выберите привилегию</option>
                                       <?php foreach ($srv['privileges'] as $priv_group=>$priv_list) {?>
                                       <optgroup label="<?=$priv_group?>">
                                          <?php foreach ($priv_list as $priv_name=>$priv) {?>
                                             <option data-price="<?=$priv['price']?>" value="<?= $priv['id'] ?>"><?= $priv_name ?> - <?= $priv['price'] ?> рублей.</option>
                                          <?php } ?>
                                       </optgroup>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <p><button class="btn btn-success btn-info-buy" type="submit" name="buy" style="width: 100%" disabled>Введите ник и выберите привилегию</button></p>
                                 <div id="info"></div>
                              </form>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>