<?php
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
include 'config.php';

ini_set('display_errors', 'Off');


function message($data, $cfg, $err = false)
{
    $entered_promocode = isset($_REQUEST['promocode']) ? $_REQUEST['promocode'] : '';
    if ($entered_promocode != '') {

        $discount = 0;
        $get_proms = $cfg['promocode'];
        $get_prom_pers = $cfg['promocode_percents'];
        $promocodes = explode('|', $get_proms);
        $promocode_percents = explode('|', $get_prom_pers);

        for ($i = 0; $i < count($promocodes); $i++) {
            if ($entered_promocode == $promocodes[$i]) {
                $discount = $promocode_percents[$i] / 100;
            }
        }
    }

    return json_encode(array(
        'error' => $err,
        'data' => $data,
        'promo_discount' => $discount,
    ));
}

if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'extra') {
    include_once 'classes/Main.class.php';
    $main = new Main();
    echo message($main->get_extra($_REQUEST['nick'], $_REQUEST['srv'], $_REQUEST['group']), $cfg);
} else {
    include_once 'classes/Pay.class.php';
    $pay = new Pay();
    if ($pay->if_pay($_REQUEST)) echo $pay->handler($_REQUEST);
    else echo message('Ошибка типа запроса! ', true);
}
