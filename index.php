<?php
include 'classes/Main.class.php';
$main = new Main();

?>

<html>

<head>
    <meta charset="utf-8">
    <title>PandaMine - Покупка доната, привилегий, кейсов на сервере Minecraft</title>
    <meta name="description" content="PandaMine - Сайт покупки доната или привилегий и донат кейсов для сервера майнкрафт. Скидки!">
    <meta name="keywords" content="донат,привилегии,ключи,pandamine,сервер майнкрафт|raw">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="/images/panda-back.png">

    <?php include 'header/wp_head.php' ?>

    <style>
        #hint-list {
            width: 100%;
            position: absolute;
            background-color: #ffffff;
            border-radius: 0 0 1em 1em;
            list-style-type: none;
            z-index: 10;
            max-height: 16em;
            overflow: scroll;
            box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
        }

        ::marker {
            color: #3cb521;
        }

        #hint-list li::before {
            content: '';
            width: 1.1em;
            height: 1.1em;
            border-radius: 50%;
            position: absolute;
            background-color: #74ff919c;
            top: 50%;
            transform: translate(-140%, -50%);
        }

        #hint-list li::after {
            content: '';
            width: 0.7em;
            height: 0.7em;
            border-radius: 50%;
            position: absolute;
            background-color: #14e359;
            left: 1.45em;
            top: 50%;
            transform: translate(-400%, -50%);
        }

        #hint-list li {
            padding: 0.5em 0em;
            position: relative;
            cursor: pointer;
            transition: all 0.225s ease-in-out;
        }

        #hint-list li:hover {
            transform: translate(0.5em, 0px);
        }

        #hint-list li span {
            position: absolute;
            margin-left: 0.5em;
            text-transform: uppercase;
            color: #a1a1a1;
        }
    </style>
</head>

<body>
    <?php include 'header/header.php' ?>

    <div class="col-md-12">
        <center><img src="./images/thumbnail.jpeg" class="img-fluid" style="width: 100%; max-width: 1100px; box-shadow: 0px 0px 30px 10px rgba(0, 0, 0, .5);border-radius: 90px;"></center>
        <br>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php foreach ($main->messages as $message) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if ($message['err']) { ?>
                                    <div class="alert alert-dismissible alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong><?= $message['text'] ?></strong>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-dismissible alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong><?= $message['text'] ?></strong>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="alert alert-dismissable alert-success text-center">
                        <button contenteditable="false" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?= $main->cfg['message'] ?>
                    </div>
                    <div id="tabs-for-js" class="panel panel-default panelServers">
                        <div class="panel-heading">
                            <ul id="server-id-js" class="nav nav-tabs tabsServers">
                                <?php $i = 0;
                                foreach ($main->cfg['servers'] as $srv_name => $srv) {
                                    $i++; ?>
                                    <li role="presentation" class="<?= $i == 1 ? 'active' : '' ?>"><a href="#srv-<?= $i ?>" data-index="<?php echo $i ?>" data-toggle="tab"><?= $srv_name ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div id="myTabContent" class="tab-content">
                                <?php $i = 0;
                                foreach ($main->cfg['servers'] as $srv_name => $srv) {
                                    $i++; ?>
                                    <div class="tab-pane fade in <?= $i == 1 ? 'active' : '' ?>" id="srv-<?= $i ?>">
                                        <form autocomplete="off" method="post" class="phpmc_buy" data-ready="0" action="/">
                                            <input type="hidden" name="srv_id" class="input-srv_id" value="<?= $srv['srv_id'] ?>">
                                            <div class="alert alert-dismissable alert-warning text-center">
                                                Вы выбрали: <strong><?= $srv_name ?></strong>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="nick" class="control-label">Введите ваш ник:</label>
                                                <input type="text" name="nick" class="form-control input-nick" required="" placeholder="Введите ваш ник">
                                                <!--<ul id="hint-list"></ul> -->
                                            </div>
                                            <div class="form-group">
                                                <label for="group" class="control-label">Выберите привилегию:</label>
                                                <select name="group" class="form-control select-group" required="">
                                                    <option selected="" disabled="">Выберите привилегию</option>
                                                    <?php foreach ($srv['privileges'] as $priv_group => $priv_list) { ?>
                                                        <optgroup label="<?= $priv_group ?>">
                                                            <?php foreach ($priv_list as $priv_name => $priv) { ?>
                                                                <option data-price="<?= $priv['price'] ?>" value="<?= $priv['id'] ?>"><?= $priv_name ?> - <?= $priv['price'] ?> рублей.</option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="upload-field form-group" style="display: none;">
                                                <label for="upload" class="control-label">Выберете Банер:</label>
                                                <input class="file" type="file" name="upload" class="form-control" accept="image/*" />
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="promocode" class="control-label">Введите промокод:</label>
                                                <input type="text" name="promocode" class="form-control input-promocode" placeholder="если есть">
                                            </div>
                                            <input type="hidden" name="type" value="anypay">
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



    <!-- JavaScript to capture data-index and send it to the server -->
    <!--<script>-->
    <!--    document.addEventListener("DOMContentLoaded", function () {-->
    <!--// Get the element with the data-index attribute-->
    <!--        var ulElement = document.getElementById('server-id-js');-->
    <!--        var aElements = ulElement.querySelectorAll('[data-toggle="tab"]');-->
    <!--        console.log(aElements)-->

    <!--        aElements.forEach(element => {-->
    <!--            element.addEventListener('click', function (e) {-->
    <!--                var dataIndex = e.target.getAttribute('data-index')-->
    <!--                server_request(dataIndex);-->
    <!--            })-->
    <!--            if (element.parentElement.classList.contains('active') == true) {-->
    <!--                var dataIndex = element.getAttribute('data-index')-->
    <!--                server_request(dataIndex);-->
    <!--            }-->
    <!--        });-->
    <!--// Get the data-index attribute value-->

    <!--       function server_request(dataIndex) {-->
    <!--// Send the value to the server using AJAX-->
    <!--            var xhr = new XMLHttpRequest();-->
    <!--            xhr.open("POST", "./server_list.php", true);-->
    <!--            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");-->
    <!--            xhr.onreadystatechange = function () {-->
    <!--                if (xhr.readyState === 4 && xhr.status === 200) {-->

    <!--// Handle the server's response if needed-->
    <!--                    var data = JSON.parse(xhr.responseText);-->
    <!--                    console.log("DATA:", data);-->

    <!--                    var users = data[1];-->
    <!--                    console.log("users:", users);-->

    <!--// Input element and hint list-->
    <!--                    var tabContainer = document.getElementById('tabs-for-js');-->

    <!--// Add an input event listener to the input field-->
    <!--                    tabContainer.addEventListener('input', function (e) {-->
    <!--                        var inputElement = e.target;-->
    <!--                        if (inputElement.classList.contains('input-nick')) {-->
    <!--                            var hintList = inputElement.nextElementSibling;-->

    <!--var inputText = inputElement.value.toLowerCase(); // Convert input to lowercase-->
    <!--                        var matches = [];-->

    <!--// Filter the array for matches-->
    <!--                        if (inputText) {-->
    <!--                            matches = users.filter(function (item) {-->
    <!--                                return [item[1].toLowerCase().includes(inputText), item[0].toLowerCase().includes(inputText)];-->
    <!--                            });-->
    <!--                        }-->

    <!--// Clear the hint list-->
    <!--                        hintList.innerHTML = '';-->

    <!--// Display matching hints-->
    <!--                        matches.forEach(function (match) {-->
    <!--                            var hintItem = document.createElement('li');-->
    <!--                            var span = document.createElement("span");-->
    <!--                            span.textContent = match[0];-->
    <!--                            hintItem.textContent = match[1];-->
    <!--                            if (match[0] == "luxor") {-->
    <!--                                span.style.color = "#E664F3";-->
    <!--                            }-->
    <!--                            hintItem.append(span);-->
    <!--                            hintList.appendChild(hintItem);-->
    <!--                        });-->

    <!--// Add a click event listener to handle hint selection-->
    <!--                        hintList.addEventListener('click', function (e) {-->
    <!--                            if (e.target && e.target.nodeName === 'LI') {-->
    <!--                                inputElement.value = e.target.textContent;-->
    <!--hintList.innerHTML = ''; // Clear the hint list-->
    <!--                            }-->
    <!--                        });-->
    <!--                        }-->
    <!--                    });-->
    <!--                }-->
    <!--            };-->
    <!--            xhr.send("dataIndex=" + dataIndex);-->
    <!--       }-->

    <!--    });-->
    <!--</script>-->


</body>

</html>