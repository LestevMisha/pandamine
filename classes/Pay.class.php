<?php

/*
 * UnitPay
 */
include_once 'Config.class.php';
include_once 'DB.class.php';
include_once 'Rcon.class.php';
include_once 'Main.class.php';

class Pay {
    public function __construct(){
        $this->cfg = Config::$cfg;
    }
    public function if_pay($data) {
        if(!isset($data['method'])) return false;
        $method = $data['method'];
        if(isset($method) && ($method == 'check' || $method == 'pay' || $method == 'error')) return true;
        else return false;
    }
    public function handler($data) {
        $db = new DB();
        $method = $data['method'];
        $params = $data['params'];
        if(empty($params)) return $this->getResponseError('Параметры не были переданны!');
        if(!isset($params['signature']) OR $params['signature'] != $this->getSignature($method, $params, $this->cfg['SECRET_KEY'])) {
            return $this->getResponseError('Подпись не совпдает!');
        }
        if($method == 'check'){
            $data = $db->get('SELECT * FROM `pay` WHERE `id` = '.(int)$params['account']);
            if(!$data) return $this->getResponseError('Платёж не существует!');
            if(!empty($params['sum']) && $params['sum'] != (int)$data[0]['price'] - (int)$data[0]['extra']) {
            	return $this->getResponseError('Сумма не совподает!');
            }
            return $this->getResponseSuccess('Платёж имеет правильные данные!');
        }
        elseif($method == 'pay'){
            $data = $db->get('SELECT * FROM `pay` WHERE `id` = '.(int)$params['account']);
            if(!$data) return $this->getResponseError('Платёж не существует!');
            if($data[0]['status'] == 1) return $this->getResponseError('Платёж уже оплачен!');
            $db->query('UPDATE `pay` SET status = 1 WHERE `id` = '.(int)$params['account']);
            $group = Main::get_group($data[0]['pid'], $data[0]['srv_id']);
            $srv = Main::get_srv($data[0]['srv_id']);
            if(isset($srv['case']) && $srv['case']){
                $db_srv = new DB($srv['db']);
                if($db_srv->status !== true) return $this->getResponseError('Ошибка подключения к БД сервера! '.$db_srv->status);
                $cases = $db_srv->get("SELECT * FROM `megacase` WHERE `name`= '".$data[0]['name']."' LIMIT 1");
                if($cases){
                    $setc = $db_srv->query("UPDATE `megacase` SET `count` = `count`+ ".$group['coint_case']." WHERE `name` = '".$data[0]['name']."'");
                } else {
                    $setc = $db_srv->query("INSERT INTO `megacase` (`name`,`count`) VALUES ('".$data[0]['name']."','".$group['coint_case']."')");
                }
                if($setc) return $this->getResponseSuccess('Платёж завершён, кейс выдан');
                else return $this->getResponseError('Не удалось выдать кейс, из-за ошибки сервера, id платежа: '.$data[0]['id'].'; db_erros: '.$db_srv->mysqli->error);
            }
            else{
                $rcon = new Rcon($data[0]);
                $cmd_data = $rcon->privilege_pay($data[0]['id']);
                //@iconv('windows-1251', 'UTF-8', $cmd_data));
                if($cmd_data) return $this->getResponseSuccess('Платёж завершён, ответ сервера: '.preg_replace('![^\w\d\s]*!','',$cmd_data));
                else return $this->getResponseError('Не удалось выдать товар на сервере, id платежа: '.$data[0]['id']);
            }
            return $this->getResponseError('Ошибка обработки товара, id платежа: '.$data[0]['id']);
        }
        else return $this->getResponseError('Метод не поддерживается: '.$method);
    }
    public function redirect($account, $sum, $privilege_name, $promo, $name){
        $signature = hash('sha256', $account.'{up}RUB{up}Покупка группы '.$privilege_name.'{up}'.$sum.'{up}'.$this->cfg['SECRET_KEY']);
        //exit(header('Location: https://unitpay.ru/pay/'.$this->cfg['PUBLIC_KEY'].'?sum='.$sum.'&account='.$account.'&desc=Покупка группы '.$privilege_name.'&currency=RUB&signature='.$signature));
        $url = "/classes/anypay.pay.php?order_amount={$sum}&custom_field={$account}&comment={$privilege_name}&name={$name}";

        if (!empty($promo)) {
            $url .= "&promocode={$promo}";
        }
        
        exit(header("Location: " . $url));
        // exit(header("Location: /classes/anypay.pay.php?order_amount={$sum}&custom_field={$account}&comment={$privilege_name}&promocode={$promo}"));
       }
    private function getResponseSuccess($message){
        return @json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ),JSON_PARTIAL_OUTPUT_ON_ERROR);
    }

    private function getResponseError($message){
        return @json_encode(array(
            "jsonrpc" => "2.0",
            "error" => array(
                "code" => -32000,
                "message" => $message
            ),
            'id' => 1
        ),JSON_PARTIAL_OUTPUT_ON_ERROR);
    }
    private function getSignature($method, array $params, $secretKey) {
        ksort($params);
        unset($params['sign']);
        unset($params['signature']);
        array_push($params, $secretKey);
        array_unshift($params, $method);
        return hash('sha256', join('{up}', $params));
    }
}

?>