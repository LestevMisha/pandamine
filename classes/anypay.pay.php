<?php
require_once "anypay.config.php";
include $_SERVER['DOCUMENT_ROOT'].'/config.php';
include 'Main.class.php';


if(!$_GET['order_amount'] || !$_GET['comment'] || !$_GET['custom_field'])
    die('Bad arguments');

$order_id = $_GET['comment'];
$order_amount = $_GET['order_amount'];

// check if there's correct promo
$get_proms = $cfg['promocode'];
$get_prom_pers = $cfg['promocode_percents'];

$promocodes = explode('|', $get_proms);
$promocodes_percents = explode('|', $get_prom_pers);

$entered_promocode = isset($_GET['promocode']) ? $_GET['promocode'] : '';

for ($i = 0; $i < count($promocodes); $i++) {
    if ($entered_promocode == $promocodes[$i]) {
        $discount = $order_amount * ($promocodes_percents[$i] / 100);
        $order_amount -= $discount;
    }
}


$sign = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$currency.':'.$order_id);
?>

<style>
    body
    {
        background-color: black;
    }
</style>

<center>Ожидайте, сейчас вас перенаправит на страницу оплаты.</center>
<form id="anypay" action='https://pay.freekassa.ru/' method='get'>
        <input type='hidden' name='m' value='<?php echo $merchant_id ?>'>
        <input type="hidden" name="oa" value='<?php echo $order_amount ?>'>
        <input type='hidden' name='o' value='<?php echo $order_id ?>'>
        <input type='hidden' name='s' value='<?php echo $sign ?>'>
        <input type='hidden' name='currency' value='<?php echo $currency ?>'>
        <input type='hidden' name='lang' value='ru'>
        <input type='hidden' name='us_custom_field' value='<?php echo $_GET['custom_field']; ?>'>
        <input type='hidden' name='us_name' value='<?php echo $_GET['name']; ?>'>
        <input type='hidden' name='us_img_name' value='<?php echo $_GET['img_name']; ?>'>
</form>

<script>
    document.getElementById('anypay').submit();
</script>